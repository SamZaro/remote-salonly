<?php

namespace App\Filament\Admin\Resources\AvailabilityExceptions\Pages;

use App\Filament\Admin\Resources\AvailabilityExceptions\AvailabilityExceptionResource;
use App\Filament\CrudDefaults;
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
