<?php

namespace App\Filament\Dashboard\Resources\Sections\Pages;

use App\Filament\Dashboard\Resources\Sections\TemplateSectionResource;
use App\Models\Template;
use App\Services\TemplateService;
use App\Settings\SiteSettings;
use Filament\Resources\Pages\CreateRecord;

class CreateSection extends CreateRecord
{
    protected static string $resource = TemplateSectionResource::class;

    /**
     * Mutate form data before creating to set the template_id.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $templateSlug = app(SiteSettings::class)->template_slug;
        $template = Template::where('slug', $templateSlug)->first();

        $data['template_id'] = $template?->id;

        return $data;
    }

    /**
     * Clear template cache after creating a section.
     */
    protected function afterCreate(): void
    {
        app(TemplateService::class)->clearCache();
    }
}
