<?php

namespace App\Filament\Admin\Resources\Templates\RelationManagers;

use App\Filament\Schemas\SectionFormSchemas;
use App\Services\TemplateService;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    protected static ?string $title = 'Sections';

    public function form(Schema $schema): Schema
    {
        // Get the category slug from the owner record (Template)
        $categorySlug = $this->getOwnerRecord()->category?->slug;

        return $schema
            ->components([
                Section::make(__('Section Details'))
                    ->schema([
                        Select::make('section_type')
                            ->label(__('Section Type'))
                            ->options([
                                'hero' => __('Hero'),
                                'slider' => __('Slider'),
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
                                //'stats' => __('Statistics'),
                                'portfolio' => __('Portfolio'),
                                //'blog' => __('Blog'),
                                //'newsletter' => __('Newsletter'),
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

                // Dynamic content schema based on section type and category
                Group::make()
                    ->schema(fn (Get $get): array => SectionFormSchemas::getContentSchema($get('section_type') ?? 'custom', $categorySlug))
                    ->columnSpanFull(),

                // Dynamic media schema based on section type
                Group::make()
                    ->schema(fn (Get $get): array => SectionFormSchemas::getMediaSchema($get('section_type') ?? 'custom'))
                    ->visible(fn (Get $get): bool => SectionFormSchemas::hasMedia($get('section_type') ?? 'custom'))
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('section_type')
                    ->label(__('Type'))
                    ->badge()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('order')
                    ->label(__('Order'))
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label(__('Active')),
                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime(config('app.datetime_format'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->reorderRecordsTriggerAction(
                fn ($action, bool $isReordering) => $action
                    ->button()
                    ->label($isReordering ? __('Klaar') : __('Volgorde Aanpassen'))
            )
            ->paginated(false)
            ->headerActions([
                CreateAction::make()
                    ->after(fn () => $this->clearTemplateCache()),
            ])
            ->recordActions([
                EditAction::make()
                    ->after(fn () => $this->clearTemplateCache()),
                DeleteAction::make()
                    ->after(fn () => $this->clearTemplateCache()),
            ])
            ->toolbarActions([
                DeleteBulkAction::make()
                    ->after(fn () => $this->clearTemplateCache()),
            ]);
    }

    /**
     * Override Filament's reorderTable method to clear cache after reordering.
     */
    public function reorderTable(array $order, string|int|null $draggedRecordKey = null): void
    {
        // Call parent to do the actual reordering
        parent::reorderTable($order, $draggedRecordKey);

        // Clear template cache after reordering is complete
        $this->clearTemplateCache();
    }

    /**
     * Clear template cache via TemplateService.
     */
    private function clearTemplateCache(): void
    {
        app(TemplateService::class)->clearCache();
    }
}
