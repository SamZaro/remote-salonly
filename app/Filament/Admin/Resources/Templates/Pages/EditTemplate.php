<?php

namespace App\Filament\Admin\Resources\Templates\Pages;

use App\Filament\Admin\Resources\Templates\TemplateResource;
use App\Filament\CrudDefaults;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTemplate extends EditRecord
{
    use CrudDefaults;

    protected static string $resource = TemplateResource::class;

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
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }
}
