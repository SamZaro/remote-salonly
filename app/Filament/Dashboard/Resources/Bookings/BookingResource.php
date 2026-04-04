<?php

namespace App\Filament\Dashboard\Resources\Bookings;

use App\Enums\BookingStatus;
use App\Filament\Dashboard\Resources\Bookings\Pages\ListBookings;
use App\Filament\Dashboard\Resources\Bookings\Pages\ViewBooking;
use App\Mail\Booking\BookingStatusCancelled;
use App\Mail\Booking\BookingStatusConfirmed;
use App\Models\Booking;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    protected static ?int $navigationSort = 0;

    public static function getNavigationGroup(): ?string
    {
        return __('Bookings');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Bookings');
    }

    public static function getModelLabel(): string
    {
        return __('Booking');
    }

    public static function getNavigationLabel(): string
    {
        return __('Bookings');
    }

    public static function canAccess(): bool
    {
        return \App\Booking\BookingModuleManager::isEnabled()
            && (auth()->user()?->hasPermissionTo('booking.view') ?? false);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->hasPermissionTo('booking.delete') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_date')
                    ->label(__('Date'))
                    ->date('d-m-Y')
                    ->sortable(),
                TextColumn::make('booking_time')
                    ->label(__('Time'))
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('H:i')),
                TextColumn::make('customer_name')
                    ->label(__('Customer'))
                    ->searchable(),
                TextColumn::make('customer_email')
                    ->label(__('Email'))
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('customer_phone')
                    ->label(__('Phone'))
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->formatStateUsing(fn (BookingStatus $state) => $state->label())
                    ->color(fn (BookingStatus $state) => $state->color()),
                TextColumn::make('notes')
                    ->label(__('Notes'))
                    ->limit(30)
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->dateTime(config('app.datetime_format'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('upcoming')
                    ->label(__('Upcoming'))
                    ->query(fn (Builder $query) => $query->where('booking_date', '>=', now()->toDateString()))
                    ->default(),
                SelectFilter::make('status')
                    ->label(__('Status'))
                    ->options([
                        'pending' => __('Pending'),
                        'confirmed' => __('Confirmed'),
                        'cancelled' => __('Cancelled'),
                    ]),
                Filter::make('today')
                    ->label(__('Today'))
                    ->query(fn (Builder $query) => $query->whereDate('booking_date', now())),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('confirm')
                    ->label(__('Confirm'))
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === BookingStatus::Pending
                        && auth()->user()?->hasPermissionTo('booking.update'))
                    ->requiresConfirmation()
                    ->modalHeading(__('Confirm Booking'))
                    ->modalDescription(__('Are you sure you want to confirm this booking?'))
                    ->modalSubmitActionLabel(__('Confirm'))
                    ->action(function ($record) {
                        $record->update(['status' => BookingStatus::Confirmed]);
                        Mail::to($record->customer_email)->send(new BookingStatusConfirmed($record));
                    }),
                Action::make('cancel')
                    ->label(__('Cancel'))
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => in_array($record->status, [BookingStatus::Pending, BookingStatus::Confirmed])
                        && auth()->user()?->hasPermissionTo('booking.update'))
                    ->requiresConfirmation()
                    ->modalHeading(__('Cancel Booking'))
                    ->modalDescription(__('Are you sure you want to cancel this booking?'))
                    ->modalSubmitActionLabel(__('Cancel'))
                    ->action(function ($record) {
                        $record->update(['status' => BookingStatus::Cancelled]);
                        Mail::to($record->customer_email)->send(new BookingStatusCancelled($record));
                    }),
                DeleteAction::make()
                    ->label(__('Delete'))
                    ->visible(fn ($record) => auth()->user()?->hasPermissionTo('booking.delete')),
            ])
            ->defaultSort('booking_date', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookings::route('/'),
            'view' => ViewBooking::route('/{record}'),
        ];
    }
}
