<?php

namespace App\Filament\Dashboard\Resources\BusinessHours\Pages;

use App\Filament\Dashboard\Resources\BusinessHours\BusinessHoursResource;
use App\Filament\ListDefaults;
use Filament\Resources\Pages\ListRecords;

class ListBusinessHours extends ListRecords
{
    use ListDefaults;

    protected static string $resource = BusinessHoursResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
