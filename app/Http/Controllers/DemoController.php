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
        //Voorkom toegang tot de demo als er al een template is ingesteld in de site-instellingen
        //if (app(SiteSettings::class)->template_slug) {
        //    abort(404);
        //}

        // Laad de template met de actieve en geordende secties en categorie
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
