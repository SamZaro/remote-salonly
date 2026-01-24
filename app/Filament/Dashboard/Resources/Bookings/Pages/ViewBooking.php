<?php

namespace App\Filament\Dashboard\Resources\Bookings\Pages;

use App\Enums\BookingStatus;
use App\Filament\Dashboard\Resources\Bookings\BookingResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViewBooking extends ViewRecord
{
    protected static string $resource = BookingResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Reserveringsgegevens'))
                    ->schema([
                        TextEntry::make('booking_date')
                            ->label(__('Datum'))
                            ->date('d-m-Y'),
                        TextEntry::make('booking_time')
                            ->label(__('Tijd'))
                            ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('H:i')),
                        TextEntry::make('status')
                            ->label(__('Status'))
                            ->badge()
                            ->formatStateUsing(fn (BookingStatus $state) => $state->label())
                            ->color(fn (BookingStatus $state) => $state->color()),
                    ])
                    ->columns(3),

                Section::make(__('Klantgegevens'))
                    ->schema([
                        TextEntry::make('customer_name')
                            ->label(__('Naam')),
                        TextEntry::make('customer_email')
                            ->label(__('E-mail')),
                        TextEntry::make('customer_phone')
                            ->label(__('Telefoon'))
                            ->placeholder('-'),
                    ])
                    ->columns(3),

                Section::make(__('Extra informatie'))
                    ->schema([
                        TextEntry::make('notes')
                            ->label(__('Notities'))
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('created_at')
                            ->label(__('Aangemaakt op'))
                            ->dateTime(config('app.datetime_format')),
                        TextEntry::make('updated_at')
                            ->label(__('Laatst bijgewerkt'))
                            ->dateTime(config('app.datetime_format')),
                    ])
                    ->columns(2),
            ]);
    }
}
