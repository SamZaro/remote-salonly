<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Services\TemplateService;
use App\Settings\SiteSettings;
use Illuminate\View\View;

class DemoController extends Controller
{
    public function __construct(
        private TemplateService $templateService
    ) {}

    public function show(string $slug): View
    {
        // Prevent access to demo if a template is already set in site settings
        if (app(SiteSettings::class)->template_slug) {
            abort(404);
        }

        // Load the template with its active and ordered sections and category
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
