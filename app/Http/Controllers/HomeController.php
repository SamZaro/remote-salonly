<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Services\TemplateService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private TemplateService $templateService
    ) {}

    public function index(Request $request): View
    {
        // Check if preview mode is enabled
        if ($request->has('preview')) {
            $previewSlug = $request->get('preview');
            $previewTemplate = Template::with(['sections' => fn ($q) => $q->active()->ordered(), 'category'])
                ->where('slug', $previewSlug)
                ->first();

            if ($previewTemplate) {
                // Check for unsaved form data in session
                $sessionPreview = session()->pull('template_preview_data');

                if ($sessionPreview && $sessionPreview['slug'] === $previewSlug) {
                    // Merge unsaved theme_config over the database values
                    $previewTemplate->theme_config = array_merge(
                        $previewTemplate->theme_config ?? [],
                        $sessionPreview['theme_config'] ?? []
                    );

                    // Override navigation items if provided
                    if (! empty($sessionPreview['navigation_items'])) {
                        $previewTemplate->navigation_items = $sessionPreview['navigation_items'];
                    }
                }

                // Temporarily set the preview template
                $this->templateService->setActiveTemplate($previewTemplate);
            }
        }

        $template = $this->templateService->getActiveTemplate();
        $sections = $this->templateService->getSections();
        $theme = $this->templateService->getTheme();
        $navigation = $this->templateService->getNavigationItems();

        return view('home', [
            'template' => $template,
            'sections' => $sections,
            'theme' => $theme,
            'navigation' => $navigation,
            'isPreview' => $request->has('preview'),
        ]);
    }
}
