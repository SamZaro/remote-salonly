<?php

namespace App\Filament\Admin\Resources\AvailabilityExceptions\Pages;

use App\Filament\Admin\Resources\AvailabilityExceptions\AvailabilityExceptionResource;
use App\Filament\CrudDefaults;
use Filament\Resources\Pages\CreateRecord;

class CreateAvailabilityException extends CreateRecord
{
    use CrudDefaults;

    protected static string $resource = AvailabilityExceptionResource::class;
}
