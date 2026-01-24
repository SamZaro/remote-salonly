<?php

namespace App\Filament\Admin\Pages;

use App\Models\Template;
use App\Services\TemplateService;
use App\Settings\SiteSettings;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ManageSiteSettings extends SettingsPage
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 10;

    protected static string $settings = SiteSettings::class;

    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('Site Settings');
    }

    public function getTitle(): string
    {
        return __('Site Settings');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('clearTemplateCache')
                ->label(__('Clear Template Cache'))
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->action(function () {
                    app(TemplateService::class)->clearCache();
                    Notification::make()
                        ->title(__('Template cache cleared successfully'))
                        ->success()
                        ->send();
                })
                ->requiresConfirmation(),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('General Settings'))
                    ->schema([
                        TextInput::make('site_name')
                            ->label(__('Site Name'))
                            ->required()
                            ->maxLength(255),

                        FileUpload::make('logo')
                            ->label(__('Logo'))
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'])
                            ->maxSize(5120)
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('logos')
                            ->visibility('public')
                            ->helperText(__('Upload a logo for your site. Accepted formats: PNG, JPG, SVG. Max size: 5MB.')),
                    ])
                    ->columns(1),

                Section::make(__('Active Template'))
                    ->description(__('Select which template to use for your website frontend.'))
                    ->schema([
                        Select::make('template_slug')
                            ->label(__('Template'))
                            ->options(fn () => Template::query()
                                ->active()
                                ->ordered()
                                ->pluck('name', 'slug')
                                ->toArray()
                            )
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->helperText(__('Choose a template from the available templates. Leave empty for no template.'))
                            ->reactive()
                            ->afterStateUpdated(function () {
                                // Clear cache when template changes
                                app(TemplateService::class)->clearCache();
                            }),

                        Placeholder::make('active_template_info')
                            ->label(__('Template Info'))
                            ->content(function ($get) {
                                $slug = $get('template_slug');
                                if (! $slug) {
                                    return __('No template selected');
                                }

                                $template = Template::where('slug', $slug)->first();
                                if (! $template) {
                                    return __('Template not found');
                                }

                                return sprintf(
                                    '%s - %s',
                                    $template->name,
                                    $template->description ?? __('No description')
                                );
                            })
                            ->visible(fn ($get) => (bool) $get('template_slug')),
                    ])
                    ->columns(1),

                Section::make(__('Advanced Template Configuration'))
                    ->description(__('Advanced configuration for template customization (JSON format).'))
                    ->schema([
                        Textarea::make('template_config')
                            ->label(__('Template Configuration'))
                            ->rows(10)
                            ->formatStateUsing(fn ($state) => $state ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : null)
                            ->dehydrateStateUsing(function ($state) {
                                if (empty($state)) {
                                    return null;
                                }

                                $decoded = json_decode($state, true);
                                if (json_last_error() !== JSON_ERROR_NONE) {
                                    Notification::make()
                                        ->title(__('Invalid JSON format'))
                                        ->danger()
                                        ->send();

                                    return null;
                                }

                                return $decoded;
                            })
                            ->helperText(__('Override template configuration in JSON format. This will be merged with the template\'s default theme_config.')),
                    ])
                    ->columns(1)
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    protected function afterSave(): void
    {
        // Clear template cache after saving
        app(TemplateService::class)->clearCache();

        Notification::make()
            ->title(__('Settings saved successfully'))
            ->success()
            ->send();
    }
}
