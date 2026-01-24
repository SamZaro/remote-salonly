<?php

namespace App\Observers;

use App\Models\TemplateSection;
use App\Services\TemplateService;

class TemplateSectionObserver
{
    public function __construct(
        private TemplateService $templateService
    ) {}

    /**
     * Handle the TemplateSection "created" event.
     */
    public function created(TemplateSection $templateSection): void
    {
        $this->clearTemplateCache();
    }

    /**
     * Handle the TemplateSection "updated" event.
     */
    public function updated(TemplateSection $templateSection): void
    {
        $this->clearTemplateCache();
    }

    /**
     * Handle the TemplateSection "deleted" event.
     */
    public function deleted(TemplateSection $templateSection): void
    {
        $this->clearTemplateCache();
    }

    /**
     * Handle the TemplateSection "restored" event.
     */
    public function restored(TemplateSection $templateSection): void
    {
        $this->clearTemplateCache();
    }

    /**
     * Handle the TemplateSection "force deleted" event.
     */
    public function forceDeleted(TemplateSection $templateSection): void
    {
        $this->clearTemplateCache();
    }

    /**
     * Clear the template cache via TemplateService.
     */
    private function clearTemplateCache(): void
    {
        $this->templateService->clearCache();
    }
}
