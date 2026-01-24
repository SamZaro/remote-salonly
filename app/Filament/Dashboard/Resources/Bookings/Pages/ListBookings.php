<?php

namespace App\Filament\Dashboard\Resources\Bookings\Pages;

use App\Filament\Dashboard\Resources\Bookings\BookingResource;
use App\Filament\ListDefaults;
use Filament\Resources\Pages\ListRecords;

class ListBookings extends ListRecords
{
    use ListDefaults;

    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
