<?php

namespace App\Filament\Dashboard\Resources\Templates;

use App\Filament\Dashboard\Resources\Templates\Pages\EditTemplate;
use App\Filament\Schemas\TemplateFormSchema;
use App\Models\Template;
use App\Settings\SiteSettings;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class TemplateResource extends Resource
{
    protected static ?string $model = Template::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-paint-brush';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'template';

    public static function getNavigationGroup(): ?string
    {
        return __('Website');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Template');
    }

    public static function getModelLabel(): string
    {
        return __('Template');
    }

    public static function getNavigationLabel(): string
    {
        return __('Template');
    }

    /**
     * Scope the query to only show the site's template.
     */
    public static function getEloquentQuery(): Builder
    {
        $templateSlug = app(SiteSettings::class)->template_slug;

        return parent::getEloquentQuery()
            ->where('slug', $templateSlug);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Template')
                    ->tabs(TemplateFormSchema::dashboardTabs())
                    ->columnSpanFull(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => EditTemplate::route('/'),
        ];
    }

    /**
     * Disable creation - users can only edit their existing template.
     */
    public static function canCreate(): bool
    {
        return false;
    }
}
