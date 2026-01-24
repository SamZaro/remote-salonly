<?php

namespace App\Filament\Dashboard\Resources\AvailabilityExceptions\Pages;

use App\Filament\CrudDefaults;
use App\Filament\Dashboard\Resources\AvailabilityExceptions\AvailabilityExceptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAvailabilityException extends EditRecord
{
    use CrudDefaults;

    protected static string $resource = AvailabilityExceptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
