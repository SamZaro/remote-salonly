<?php

namespace App\Filament\Dashboard\Pages;

use App\Services\ConfigService;
use Filament\Pages\Page;

class GeneralSettings extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 99;

    protected string $view = 'filament.dashboard.pages.general-settings';

    public static function getNavigationGroup(): ?string
    {
        return __('Instellingen');
    }

    public static function getNavigationLabel(): string
    {
        return __('General Settings');
    }

    public function getTitle(): string
    {
        return __('General Settings');
    }

    public static function canAccess(): bool
    {
        $configService = app()->make(ConfigService::class);

        return $configService->isAdminSettingsEnabled()
            && auth()->user()
            && auth()->user()->hasPermissionTo('manage general settings');
    }
}
