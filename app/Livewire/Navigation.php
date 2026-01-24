<?php

namespace App\Livewire;

use App\Models\Template;
use App\Services\TemplateService;
use App\Settings\SiteSettings;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Navigation extends Component
{
    #[Computed]
    public function navItems(): array
    {
        return app(TemplateService::class)->getNavigationItems();
    }

    #[Computed]
    public function settings(): SiteSettings
    {
        return app(SiteSettings::class);
    }

    #[Computed]
    public function template(): ?Template
    {
        return app(TemplateService::class)->getActiveTemplate();
    }

    #[Computed]
    public function theme(): array
    {
        return app(TemplateService::class)->getTheme();
    }

    public function render()
    {
        return view('livewire.navigation');
    }
}
