<?php

namespace App\Filament\Dashboard\Resources\Sections;

use App\Filament\Dashboard\Resources\Sections\Pages\CreateSection;
use App\Filament\Dashboard\Resources\Sections\Pages\EditSection;
use App\Filament\Dashboard\Resources\Sections\Pages\ListSections;
use App\Filament\Schemas\SectionFormSchemas;
use App\Models\Template;
use App\Models\TemplateSection;
use App\Services\TemplateService;
use App\Settings\SiteSettings;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TemplateSectionResource extends Resource
{
    protected static ?string $model = TemplateSection::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'sections';

    public static function getNavigationGroup(): ?string
    {
        return __('Website');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Sections');
    }

    public static function getModelLabel(): string
    {
        return __('Section');
    }

    public static function getNavigationLabel(): string
    {
        return __('Sections');
    }

    /**
     * Scope the query to only show sections for the site's template.
     */
    public static function getEloquentQuery(): Builder
    {
        $templateSlug = app(SiteSettings::class)->template_slug;
        $template = Template::where('slug', $templateSlug)->first();

        return parent::getEloquentQuery()
            ->where('template_id', $template?->id);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section details (section_type select + is_active toggle) - only visible on create
                Section::make(__('Section Details'))
                    ->schema([
                        Select::make('section_type')
                            ->label(__('Section Type'))
                            ->options([
                                'hero' => __('Hero'),
                                'about' => __('About'),
                                'services' => __('Services'),
                                'features' => __('Features'),
                                'pricing' => __('Pricing'),
                                'testimonials' => __('Testimonials'),
                                'team' => __('Team'),
                                'gallery' => __('Gallery'),
                                'parallax' => __('Parallax'),
                                'faq' => __('FAQ'),
                                'accordion' => __('Accordion'),
                                'jumbotron' => __('Jumbotron'),
                                'contact' => __('Contact'),
                                'cta' => __('Call to Action'),
                                'stats' => __('Statistics'),
                                'portfolio' => __('Portfolio'),
                                'blog' => __('Blog'),
                                'newsletter' => __('Newsletter'),
                                'footer' => __('Footer'),
                                'content' => __('Content'),
                                'image_text' => __('Image + Text'),
                                'text_image' => __('Text + Image'),
                                'custom' => __('Custom'),
                            ])
                            ->required()
                            ->searchable()
                            ->live()
                            ->columnSpan(2),
                        Toggle::make('is_active')
                            ->label(__('Is Active'))
                            ->default(true)
                            ->inline(false),
                    ])->columns(3),

                // Dynamic content schema based on section type
                ...self::getDynamicContentSchema(),

                // Dynamic media schema based on section type
                ...self::getDynamicMediaSchema(),
            ]);
    }

    /**
     * Get dynamic content schema components.
     */
    protected static function getDynamicContentSchema(): array
    {
        // Get the category slug from the site's template
        $categorySlug = self::getSiteTemplateCategorySlug();

        return [
            Group::make()
                ->schema(fn (Get $get): array => SectionFormSchemas::getContentSchema($get('section_type') ?? 'custom', $categorySlug))
                ->hidden(fn (string $operation): bool => $operation === 'create')
                ->columnSpanFull(),
        ];
    }

    /**
     * Get the category slug for the site's template.
     */
    protected static function getSiteTemplateCategorySlug(): ?string
    {
        $templateSlug = app(SiteSettings::class)->template_slug;
        $template = Template::with('category')->where('slug', $templateSlug)->first();

        return $template?->category?->slug;
    }

    /**
     * Get dynamic media schema components.
     */
    protected static function getDynamicMediaSchema(): array
    {
        return [
            Group::make()
                ->schema(fn (Get $get): array => SectionFormSchemas::getMediaSchema($get('section_type') ?? 'custom'))
                ->visible(fn (Get $get, string $operation): bool => $operation !== 'create' && SectionFormSchemas::hasMedia($get('section_type') ?? 'custom'))
                ->columnSpanFull(),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('section_type')
                    ->label(__('Type'))
                    ->badge()
                    ->sortable()
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label(__('Active'))
                    ->afterStateUpdated(fn () => app(TemplateService::class)->clearCache()),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->reorderRecordsTriggerAction(
                fn ($action, bool $isReordering) => $action
                    ->button()
                    ->label($isReordering ? __('Done') : __('Reorder'))
            )
            ->paginated(false)
            ->recordActions([
                EditAction::make()
                    ->after(fn () => app(TemplateService::class)->clearCache()),
                DeleteAction::make()
                    ->after(fn () => app(TemplateService::class)->clearCache()),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSections::route('/'),
            'create' => CreateSection::route('/create'),
            'edit' => EditSection::route('/{record}/edit'),
        ];
    }
}
