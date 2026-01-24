<?php

namespace App\View\Components;

use App\Models\TemplateSection as TemplateSectionModel;
use App\Services\TemplateService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TemplateSection extends Component
{
    public function __construct(
        public TemplateSectionModel $section,
        public array $content = [],
        public array $theme = [],
    ) {
        if (empty($this->content)) {
            $this->content = $section->content ?? [];
        }

        if (empty($this->theme)) {
            $this->theme = app(TemplateService::class)->getTheme();
        }
    }

    public function render(): View|Closure|string
    {
        $templateService = app(TemplateService::class);
        $viewName = $templateService->resolveSectionView($this->section->section_type);

        return view($viewName, [
            'content' => $this->content,
            'theme' => $this->theme,
            'section' => $this->section,
        ]);
    }
}
