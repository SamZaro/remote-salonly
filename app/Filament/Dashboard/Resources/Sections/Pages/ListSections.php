<?php

namespace App\Filament\Dashboard\Resources\Sections\Pages;

use App\Filament\Dashboard\Resources\Sections\TemplateSectionResource;
use App\Services\TemplateService;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSections extends ListRecords
{
    protected static string $resource = TemplateSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->after(fn () => app(TemplateService::class)->clearCache()),
        ];
    }

    /**
     * Override Filament's reorderTable method to clear cache after reordering.
     */
    public function reorderTable(array $order, string|int|null $draggedRecordKey = null): void
    {
        parent::reorderTable($order, $draggedRecordKey);

        app(TemplateService::class)->clearCache();
    }
}
