<?php

namespace App\Services;

use App\Models\Template;
use App\Models\TemplateSection;
use App\Settings\SiteSettings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class TemplateService
{
    private const CACHE_KEY = 'active_template';

    private const CACHE_TTL = 3600; // 1 hour

    private ?Template $activeTemplate = null;

    private ?SiteSettings $siteSettings = null;

    /**
     * Get the active template for this site.
     * Reads the template_slug from SiteSettings and fetches the corresponding Template.
     */
    public function getActiveTemplate(): ?Template
    {
        if ($this->activeTemplate !== null) {
            return $this->activeTemplate;
        }

        $this->activeTemplate = Cache::remember(
            self::CACHE_KEY,
            self::CACHE_TTL,
            function () {
                $slug = $this->getTemplateSlug();

                if (! $slug) {
                    return null;
                }

                return Template::with(['sections' => fn ($q) => $q->active()->ordered(), 'category'])
                    ->where('slug', $slug)
                    ->first();
            }
        );

        return $this->activeTemplate;
    }

    /**
     * Get the template slug from SiteSettings.
     */
    public function getTemplateSlug(): ?string
    {
        return $this->getSiteSettings()->template_slug;
    }

    /**
     * Get the SiteSettings instance.
     */
    private function getSiteSettings(): SiteSettings
    {
        if ($this->siteSettings === null) {
            $this->siteSettings = app(SiteSettings::class);
        }

        return $this->siteSettings;
    }

    /**
     * Get the theme configuration for the active template.
     * Merges: default theme < template theme_config < SiteSettings template_config
     */
    public function getTheme(): array
    {
        $template = $this->getActiveTemplate();
        $siteConfig = $this->getSiteSettings()->template_config ?? [];

        // Start with defaults
        $theme = $this->getDefaultTheme();

        // Merge template theme_config (if template exists)
        if ($template && is_array($template->theme_config)) {
            $theme = array_merge($theme, $template->theme_config);
        }

        // Merge site-specific overrides from SiteSettings
        if (is_array($siteConfig)) {
            $theme = array_merge($theme, $siteConfig);
        }

        return $theme;
    }

    /**
     * Get the navigation items for the active template.
     */
    public function getNavigationItems(): array
    {
        $template = $this->getActiveTemplate();

        if (! $template) {
            return [];
        }

        return collect($template->navigation_items ?? [])
            ->filter(fn ($item) => $item['is_active'] ?? true)
            ->map(function ($item) {
                // Transform data structure from label/target to title/slug
                return [
                    'title' => $item['label'] ?? $item['title'] ?? '',
                    'slug' => isset($item['target']) ? ltrim($item['target'], '#') : ($item['slug'] ?? ''),
                    'is_active' => $item['is_active'] ?? true,
                ];
            })
            ->values()
            ->toArray();
    }

    /**
     * Get the active sections for the active template.
     *
     * @return \Illuminate\Support\Collection<int, TemplateSection>
     */
    public function getSections(): \Illuminate\Support\Collection
    {
        $template = $this->getActiveTemplate();

        if (! $template) {
            return collect();
        }

        return $template->sections ?? collect();
    }

    /**
     * Resolve the view name for a section, with template-specific fallback.
     *
     * Priority:
     * 1. Template-specific: components.templates.{template-slug}.{section-type}
     * 2. Default fallback: components.sections.{section-type}
     */
    public function resolveSectionView(string $sectionType, ?string $templateSlug = null): string
    {
        // Use provided slug, or get from active template, or fallback to SiteSettings slug
        $templateSlug = $templateSlug ?? $this->getActiveTemplate()?->slug ?? $this->getTemplateSlug();

        // Try template-specific view first
        if ($templateSlug) {
            $templateView = "components.templates.{$templateSlug}.{$sectionType}";
            if (View::exists($templateView)) {
                return $templateView;
            }
        }

        // Fallback to default section view
        $defaultView = "components.sections.{$sectionType}";
        if (View::exists($defaultView)) {
            return $defaultView;
        }

        // Ultimate fallback to a generic section
        return 'components.sections.default';
    }

    /**
     * Resolve the view name for a partial (navbar, footer, etc.).
     *
     * Priority:
     * 1. Template-specific: components.templates.{template-slug}.partials.{partial}
     * 2. Default fallback: components.partials.{partial}
     */
    public function resolvePartialView(string $partial, ?string $templateSlug = null): string
    {
        // Use provided slug, or get from active template, or fallback to SiteSettings slug
        $templateSlug = $templateSlug ?? $this->getActiveTemplate()?->slug ?? $this->getTemplateSlug();

        // Try template-specific partial first
        if ($templateSlug) {
            $templateView = "components.templates.{$templateSlug}.partials.{$partial}";
            if (View::exists($templateView)) {
                return $templateView;
            }
        }

        // Fallback to default partial
        return "components.partials.{$partial}";
    }

    /**
     * Render a section with the appropriate view and data.
     */
    public function renderSection(TemplateSection $section): string
    {
        $viewName = $this->resolveSectionView($section->section_type);

        return view($viewName, [
            'content' => $section->content ?? [],
            'theme' => $this->getTheme(),
            'section' => $section,
        ])->render();
    }

    /**
     * Render a partial with the appropriate view and data.
     */
    public function renderPartial(string $partial, array $data = []): string
    {
        $viewName = $this->resolvePartialView($partial);

        return view($viewName, array_merge([
            'theme' => $this->getTheme(),
            'template' => $this->getActiveTemplate(),
            'navigation' => $this->getNavigationItems(),
        ], $data))->render();
    }

    /**
     * Clear the active template cache.
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
        $this->activeTemplate = null;
    }

    /**
     * Set the active template (useful for previewing).
     */
    public function setActiveTemplate(Template $template): void
    {
        $this->activeTemplate = $template;
    }

    /**
     * Get the default theme configuration.
     */
    private function getDefaultTheme(): array
    {
        return [
            'primary_color' => '#3b82f6',
            'secondary_color' => '#64748b',
            'accent_color' => '#f59e0b',
            'background_color' => '#ffffff',
            'text_color' => '#1f2937',
            'heading_color' => '#111827',
            'font_family' => 'Inter',
            'heading_font_family' => 'Poppins',
            'font_size_base' => '16px',
            'navbar_background' => '#ffffff',
            'navbar_text_color' => '#111827',
            'navbar_sticky' => true,
            'navbar_transparent' => false,
        ];
    }
}
