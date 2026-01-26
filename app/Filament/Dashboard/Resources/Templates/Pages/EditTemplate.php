<?php

namespace App\Filament\Dashboard\Resources\Templates\Pages;

use App\Filament\CrudDefaults;
use App\Filament\Dashboard\Resources\Templates\TemplateResource;
use App\Models\Template;
use App\Settings\SiteSettings;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditTemplate extends EditRecord
{
    use CrudDefaults;

    protected static string $resource = TemplateResource::class;

    /**
     * Get the record to edit - automatically loads the site's template.
     */
    public function mount(int|string|null $record = null): void
    {
        $templateSlug = app(SiteSettings::class)->template_slug;
        $template = Template::where('slug', $templateSlug)->firstOrFail();

        parent::mount($template->id);
    }

    /**
     * Hide delete action - users cannot delete their template.
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('viewLiveSite')
                ->label(__('View Live Site'))
                ->icon('heroicon-o-globe-alt')
                ->color('success')
                ->url(fn () => route('home'))
                ->openUrlInNewTab(),
            Action::make('preview')
                ->label(__('Preview'))
                ->icon('heroicon-o-eye')
                ->color('gray')
                ->action(function () {
                    // Store unsaved form data in session for preview
                    $formData = $this->form->getState();
                    session()->put('template_preview_data', [
                        'slug' => $this->record->slug,
                        'theme_config' => $formData['theme_config'] ?? [],
                        'navigation_items' => $formData['navigation_items'] ?? [],
                    ]);

                    // Open preview in new tab via JavaScript
                    $this->js('window.open("'.route('home', ['preview' => $this->record->slug]).'", "_blank")');
                }),
        ];
    }

    public function getTitle(): string
    {
        return __('Edit Template');
    }

    /**
     * Get the URL for the resource's index page (redirects back to edit since there's no list).
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
