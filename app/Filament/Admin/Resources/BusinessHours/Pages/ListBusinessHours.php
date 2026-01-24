<?php

namespace App\Filament\Admin\Resources\BusinessHours\Pages;

use App\Filament\Admin\Resources\BusinessHours\BusinessHoursResource;
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
