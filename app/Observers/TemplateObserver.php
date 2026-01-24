<?php

namespace App\Observers;

use App\Models\Template;
use App\Services\TemplateService;

class TemplateObserver
{
    public function __construct(
        private TemplateService $templateService
    ) {}

    /**
     * Handle the Template "saved" event.
     * This fires on both create and update.
     */
    public function saved(Template $template): void
    {
        $this->templateService->clearCache();
    }

    /**
     * Handle the Template "deleted" event.
     */
    public function deleted(Template $template): void
    {
        $this->templateService->clearCache();
    }
}
