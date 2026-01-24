<?php

namespace App\Filament\Admin\Resources\AvailabilityExceptions\Pages;

use App\Filament\Admin\Resources\AvailabilityExceptions\AvailabilityExceptionResource;
use App\Filament\ListDefaults;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAvailabilityExceptions extends ListRecords
{
    use ListDefaults;

    protected static string $resource = AvailabilityExceptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
