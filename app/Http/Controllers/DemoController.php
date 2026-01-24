<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Services\TemplateService;
use Illuminate\View\View;

class DemoController extends Controller
{
    public function __construct(
        private TemplateService $templateService
    ) {}

    public function show(string $slug): View
    {
        $template = Template::with(['sections' => fn ($q) => $q->active()->ordered(), 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        $this->templateService->setActiveTemplate($template);

        return view('demo.show', [
            'template' => $template,
            'sections' => $this->templateService->getSections(),
            'theme' => $this->templateService->getTheme(),
            'navigation' => $this->templateService->getNavigationItems(),
            'demoMode' => true,
        ]);
    }
}
