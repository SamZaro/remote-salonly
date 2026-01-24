<?php

namespace App\Filament\Admin\Resources\Bookings;

use App\Enums\BookingStatus;
use App\Filament\Admin\Resources\Bookings\Pages\ListBookings;
use App\Filament\Admin\Resources\Bookings\Pages\ViewBooking;
use App\Models\Booking;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    protected static ?int $navigationSort = 0;

    public static function getNavigationGroup(): ?string
    {
        return __('Boekingen');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Reserveringen');
    }

    public static function getModelLabel(): string
    {
        return __('Reservering');
    }

    public static function getNavigationLabel(): string
    {
        return __('Reserveringen');
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasPermissionTo('booking.view') ?? false;
    }

    public static function canCreate(): bool
    {
        return false; // Read-only for now
    }

    public static function canEdit($record): bool
    {
        return false; // Read-only for now
    }

    public static function canDelete($record): bool
    {
        return false; // Read-only for now
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
                    ->label(__('Datum'))
                    ->date('d-m-Y')
                    ->sortable(),
                TextColumn::make('booking_time')
                    ->label(__('Tijd'))
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('H:i')),
                TextColumn::make('customer_name')
                    ->label(__('Klant'))
                    ->searchable(),
                TextColumn::make('customer_email')
                    ->label(__('E-mail'))
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('customer_phone')
                    ->label(__('Telefoon'))
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->formatStateUsing(fn (BookingStatus $state) => $state->label())
                    ->color(fn (BookingStatus $state) => $state->color()),
                TextColumn::make('notes')
                    ->label(__('Notities'))
                    ->limit(30)
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label(__('Aangemaakt'))
                    ->dateTime(config('app.datetime_format'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('upcoming')
                    ->label(__('Toekomstige'))
                    ->query(fn (Builder $query) => $query->where('booking_date', '>=', now()->toDateString()))
                    ->default(),
                SelectFilter::make('status')
                    ->label(__('Status'))
                    ->options([
                        'pending' => __('In afwachting'),
                        'confirmed' => __('Bevestigd'),
                        'cancelled' => __('Geannuleerd'),
                    ]),
                Filter::make('today')
                    ->label(__('Vandaag'))
                    ->query(fn (Builder $query) => $query->whereDate('booking_date', now())),
            ])
            ->recordActions([
                ViewAction::make(),
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
