<?php

namespace App\Filament\Dashboard\Resources\AvailabilityExceptions\Pages;

use App\Filament\CrudDefaults;
use App\Filament\Dashboard\Resources\AvailabilityExceptions\AvailabilityExceptionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAvailabilityException extends CreateRecord
{
    use CrudDefaults;

    protected static string $resource = AvailabilityExceptionResource::class;
}
