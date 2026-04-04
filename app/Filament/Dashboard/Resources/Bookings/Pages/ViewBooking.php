<?php

namespace App\Filament\Dashboard\Resources\Bookings\Pages;

use App\Enums\BookingStatus;
use App\Filament\Dashboard\Resources\Bookings\BookingResource;
use App\Mail\Booking\BookingStatusCancelled;
use App\Mail\Booking\BookingStatusConfirmed;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Mail;

class ViewBooking extends ViewRecord
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('confirm')
                ->label(__('Confirm'))
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => $this->record->status === BookingStatus::Pending
                    && auth()->user()?->hasPermissionTo('booking.update'))
                ->requiresConfirmation()
                ->modalHeading(__('Confirm Booking'))
                ->modalDescription(__('Are you sure you want to confirm this booking?'))
                ->modalSubmitActionLabel(__('Confirm'))
                ->action(function () {
                    $this->record->update(['status' => BookingStatus::Confirmed]);
                    Mail::to($this->record->customer_email)->send(new BookingStatusConfirmed($this->record));
                    $this->refreshFormData(['status']);
                }),

            Action::make('cancel')
                ->label(__('Cancel'))
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn () => in_array($this->record->status, [BookingStatus::Pending, BookingStatus::Confirmed])
                    && auth()->user()?->hasPermissionTo('booking.update'))
                ->requiresConfirmation()
                ->modalHeading(__('Cancel Booking'))
                ->modalDescription(__('Are you sure you want to cancel this booking? This cannot be undone.'))
                ->modalSubmitActionLabel(__('Cancel'))
                ->action(function () {
                    $this->record->update(['status' => BookingStatus::Cancelled]);
                    Mail::to($this->record->customer_email)->send(new BookingStatusCancelled($this->record));
                    $this->refreshFormData(['status']);
                }),

            DeleteAction::make()
                ->label(__('Delete'))
                ->visible(fn () => auth()->user()?->hasPermissionTo('booking.delete')),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Booking Details'))
                    ->schema([
                        TextEntry::make('booking_date')
                            ->label(__('Date'))
                            ->date('d-m-Y'),
                        TextEntry::make('booking_time')
                            ->label(__('Time'))
                            ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('H:i')),
                        TextEntry::make('status')
                            ->label(__('Status'))
                            ->badge()
                            ->formatStateUsing(fn (BookingStatus $state) => $state->label())
                            ->color(fn (BookingStatus $state) => $state->color()),
                    ])
                    ->columns(3),

                Section::make(__('Customer Details'))
                    ->schema([
                        TextEntry::make('customer_name')
                            ->label(__('Name')),
                        TextEntry::make('customer_email')
                            ->label(__('Email')),
                        TextEntry::make('customer_phone')
                            ->label(__('Phone'))
                            ->placeholder('-'),
                    ])
                    ->columns(3),

                Section::make(__('Additional Information'))
                    ->schema([
                        TextEntry::make('notes')
                            ->label(__('Notes'))
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('created_at')
                            ->label(__('Created at'))
                            ->dateTime(config('app.datetime_format')),
                        TextEntry::make('updated_at')
                            ->label(__('Last updated'))
                            ->dateTime(config('app.datetime_format')),
                    ])
                    ->columns(2),
            ]);
    }
}
