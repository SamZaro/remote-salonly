<?php

namespace App\Filament\Dashboard\Resources\Sections\Pages;

use App\Filament\Dashboard\Resources\Sections\TemplateSectionResource;
use App\Services\TemplateService;
use Filament\Resources\Pages\EditRecord;

class EditSection extends EditRecord
{
    protected static string $resource = TemplateSectionResource::class;

    /**
     * Clear template cache after saving a section.
     */
    protected function afterSave(): void
    {
        app(TemplateService::class)->clearCache();
    }

    /**
     * Clear template cache after deleting a section.
     */
    protected function afterDelete(): void
    {
        app(TemplateService::class)->clearCache();
    }
}
