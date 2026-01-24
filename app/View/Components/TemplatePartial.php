<?php

namespace App\View\Components;

use App\Services\TemplateService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TemplatePartial extends Component
{
    public function __construct(
        public string $name,
        public array $theme = [],
        public array $navigation = [],
    ) {
        $templateService = app(TemplateService::class);

        if (empty($this->theme)) {
            $this->theme = $templateService->getTheme();
        }

        if (empty($this->navigation)) {
            $this->navigation = $templateService->getNavigationItems();
        }
    }

    public function render(): View|Closure|string
    {
        $templateService = app(TemplateService::class);
        $viewName = $templateService->resolvePartialView($this->name);

        return view($viewName, [
            'theme' => $this->theme,
            'template' => $templateService->getActiveTemplate(),
            'navigation' => $this->navigation,
        ]);
    }
}
