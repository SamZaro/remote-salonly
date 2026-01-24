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
                ->url(fn () => route('home', ['preview' => $this->record->slug]))
                ->openUrlInNewTab(),
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }
}
