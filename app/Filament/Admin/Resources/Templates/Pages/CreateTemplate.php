<?php

namespace App\Filament\Admin\Resources\Templates\Pages;

use App\Filament\Admin\Resources\Templates\TemplateResource;
use App\Filament\CrudDefaults;
use Filament\Resources\Pages\CreateRecord;

class CreateTemplate extends CreateRecord
{
    use CrudDefaults;

    protected static string $resource = TemplateResource::class;
}
