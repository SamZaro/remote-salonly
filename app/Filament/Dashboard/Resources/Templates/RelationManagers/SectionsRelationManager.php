<?php

namespace App\Filament\Dashboard\Resources\Templates\RelationManagers;

use App\Filament\Schemas\SectionFormSchemas;
use App\Services\TemplateService;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Hidden;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
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
                // Hidden field to preserve section_type for dynamic schema
                Hidden::make('section_type'),

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
                    ->after(fn () => $this->clearTemplateCache()),
            ]);
    }

    /**
     * Override Filament's reorderTable method to clear cache after reordering.
     */
    public function reorderTable(array $order, string|int|null $draggedRecordKey = null): void
    {
        parent::reorderTable($order, $draggedRecordKey);

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
