# Filament 4 - Tables

> **Complete referentie voor Tables: Columns, Filters, Actions, Layout en meer**

## 📋 Inhoud

1. [Overview](#overview)
2. [Columns](#columns)
3. [Filters](#filters)
4. [Actions](#actions)
5. [Layout](#layout)
6. [Summaries](#summaries)
7. [Grouping](#grouping)
8. [Empty State](#empty-state)
9. [Advanced](#advanced)

---

## Overview

Tables in Filament zijn krachtige, interactieve datatabell

en met sorting, filtering, searching, pagination en meer.

### Basic Table Setup

```php
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Actions\EditAction;

public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('name')
                ->searchable()
                ->sortable(),
            TextColumn::make('email'),
        ])
        ->filters([
            Filter::make('verified')
                ->query(fn (Builder $query) => $query->whereNotNull('email_verified_at')),
        ])
        ->recordActions([
            EditAction::make(),
        ])
        ->defaultSort('created_at', 'desc')
        ->poll('60s');
}
```

---

## Columns

### Text Column

De meest gebruikte column type:

```php
use Filament\Tables\Columns\TextColumn;

TextColumn::make('name')
    ->label('Naam')
    ->searchable() // Searchable in globale search
    ->sortable() // Sorteerbaar
    ->toggleable() // User kan hide/show
    ->copyable() // Click to copy
    ->description('Extra info onder de waarde')
    ->placeholder('Geen waarde')
    ->limit(50) // Tekst afkappen
    ->wrap() // Tekst wrap ipv truncate
    ->badge() // Als badge renderen
    ->color('primary')
    ->icon('heroicon-m-check')
    ->iconPosition('after')
    ->weight('bold')
    ->size('lg')
    ->alignEnd()
    ->formatStateUsing(fn (string $state): string => ucwords($state))
```

### Date Formatting

```php
TextColumn::make('created_at')
    ->date('d-m-Y') // 15-12-2025
    ->dateTime('d-m-Y H:i') // 15-12-2025 14:30
    ->since() // 2 dagen geleden
    ->ago() // Voor 2 dagen
```

### Money Formatting

```php
TextColumn::make('price')
    ->money('eur') // €1.234,56
    ->money('usd', divideBy: 100) // $12.35 (als stored in cents)
```

### Relationship Columns

```php
// Belongs To
TextColumn::make('author.name')
    ->sortable()
    ->searchable(),

// Has Many Count
TextColumn::make('comments_count')
    ->counts('comments')
    ->label('Reacties'),

// Has Many Exists
TextColumn::make('has_comments')
    ->exists('comments')
    ->label('Heeft reacties'),

// Custom relationship query
TextColumn::make('latest_comment')
    ->getStateUsing(fn (Post $record) => 
        $record->comments()
               ->latest()
               ->first()
               ?->content
    ),
```

### Icon Column

```php
use Filament\Tables\Columns\IconColumn;

IconColumn::make('is_active')
    ->boolean() // Auto true/false icons
    ->icon(fn ($state) => match($state) {
        true => 'heroicon-o-check-circle',
        false => 'heroicon-o-x-circle',
    })
    ->color(fn ($state) => match($state) {
        true => 'success',
        false => 'danger',
    })
```

### Image Column

```php
use Filament\Tables\Columns\ImageColumn;

ImageColumn::make('avatar')
    ->circular()
    ->size(40)
    ->defaultImageUrl(url('/images/placeholder.png'))
    ->disk('public')
    ->visibility('private'),

// Multiple images
ImageColumn::make('attachments')
    ->stacked()
    ->limit(3)
    ->limitedRemainingText(),
```

### Color Column

```php
use Filament\Tables\Columns\ColorColumn;

ColorColumn::make('color')
    ->copyable()
    ->copyMessage('Kleur gekopieerd!')
```

### Badge Column

```php
TextColumn::make('status')
    ->badge()
    ->color(fn (string $state): string => match ($state) {
        'draft' => 'gray',
        'reviewing' => 'warning',
        'published' => 'success',
        'rejected' => 'danger',
    })
    ->icon(fn (string $state): string => match ($state) {
        'draft' => 'heroicon-m-pencil',
        'reviewing' => 'heroicon-m-eye',
        'published' => 'heroicon-m-check',
        'rejected' => 'heroicon-m-x-mark',
    })
```

### Select Column (Inline Editing)

```php
use Filament\Tables\Columns\SelectColumn;

SelectColumn::make('status')
    ->options([
        'draft' => 'Draft',
        'reviewing' => 'Reviewing',
        'published' => 'Published',
    ])
    ->selectablePlaceholder(false) // Disable "-- Select --"
```

### Toggle Column (Inline Editing)

```php
use Filament\Tables\Columns\ToggleColumn;

ToggleColumn::make('is_active')
    ->onColor('success')
    ->offColor('danger')
    ->beforeStateUpdated(function ($record, $state) {
        // Run code voor update
    })
    ->afterStateUpdated(function ($record, $state) {
        // Run code na update
    })
```

### Text Input Column (Inline Editing)

```php
use Filament\Tables\Columns\TextInputColumn;

TextInputColumn::make('name')
    ->rules(['required', 'max:255'])
```

### Custom Column

```php
TextColumn::make('custom')
    ->getStateUsing(fn (Model $record): string => 
        $record->first_name . ' ' . $record->last_name
    )
```

### Column Visibility Toggle

```php
TextColumn::make('email')
    ->toggleable(isToggledHiddenByDefault: true)
```

---

## Filters

### Basic Filter

```php
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

Filter::make('verified')
    ->label('Alleen geverifieerde gebruikers')
    ->query(fn (Builder $query): Builder => 
        $query->whereNotNull('email_verified_at')
    )
    ->toggle() // Als toggle ipv checkbox
    ->default() // Active by default
```

### Select Filter

```php
use Filament\Tables\Filters\SelectFilter;

SelectFilter::make('status')
    ->options([
        'draft' => 'Draft',
        'reviewing' => 'Reviewing',
        'published' => 'Published',
    ])
    ->multiple() // Multiple select
    ->searchable() // Zoeken in options
    ->preload() // Load options meteen
```

### Relationship Filters

```php
SelectFilter::make('author')
    ->relationship('author', 'name')
    ->searchable()
    ->preload()
    ->multiple()
```

### Ternary Filter

3 states: null (all), true, false

```php
use Filament\Tables\Filters\TernaryFilter;

TernaryFilter::make('email_verified_at')
    ->label('Email status')
    ->nullable()
    ->placeholder('Alle gebruikers')
    ->trueLabel('Geverifieerd')
    ->falseLabel('Niet geverifieerd')
```

### Trashed Filter (Soft Deletes)

```php
use Filament\Tables\Filters\TrashedFilter;

TrashedFilter::make()
```

### Date Range Filter

```php
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;

Filter::make('created_at')
    ->form([
        DatePicker::make('created_from')
            ->label('Vanaf'),
        DatePicker::make('created_until')
            ->label('Tot'),
    ])
    ->query(function (Builder $query, array $data): Builder {
        return $query
            ->when(
                $data['created_from'],
                fn (Builder $query, $date): Builder => 
                    $query->whereDate('created_at', '>=', $date),
            )
            ->when(
                $data['created_until'],
                fn (Builder $query, $date): Builder => 
                    $query->whereDate('created_at', '<=', $date),
            );
    })
    ->indicateUsing(function (array $data): array {
        $indicators = [];

        if ($data['created_from'] ?? null) {
            $indicators[] = Indicator::make('Vanaf ' . Carbon::parse($data['created_from'])->toFormattedDateString())
                ->removeField('created_from');
        }

        if ($data['created_until'] ?? null) {
            $indicators[] = Indicator::make('Tot ' . Carbon::parse($data['created_until'])->toFormattedDateString())
                ->removeField('created_until');
        }

        return $indicators;
    })
```

### Query Builder Filter

Advanced filtering met multiple conditions:

```php
use Filament\Tables\Filters\QueryBuilder;

QueryBuilder::make()
    ->constraints([
        QueryBuilder\Constraints\TextConstraint::make('name'),
        QueryBuilder\Constraints\BooleanConstraint::make('is_active'),
        QueryBuilder\Constraints\DateConstraint::make('created_at'),
        QueryBuilder\Constraints\RelationshipConstraint::make('author')
            ->selectable(IsRelatedToOperator::make()
                ->titleAttribute('name')
                ->searchable()
                ->multiple()
            ),
    ])
```

### Filter Layout

```php
->filtersLayout(FiltersLayout::AboveContent)
// Of: FiltersLayout::BelowContent (default)
// Of: FiltersLayout::Modal
```

---

## Actions

### Row Actions

Actions die per row verschijnen:

```php
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;

->recordActions([
    ViewAction::make(),
    EditAction::make(),
    DeleteAction::make(),
])
```

### Toolbar Actions

Actions boven de table:

```php
use Filament\Actions\CreateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

->toolbarActions([
    CreateAction::make(),
    BulkActionGroup::make([
        DeleteBulkAction::make(),
    ]),
])
```

### Custom Actions

```php
use Filament\Tables\Actions\Action;

Action::make('activate')
    ->label('Activeren')
    ->icon('heroicon-m-check')
    ->color('success')
    ->requiresConfirmation()
    ->action(fn (Customer $record) => $record->activate())
    ->visible(fn (Customer $record): bool => ! $record->is_active)
```

### Action With Form

```php
Action::make('updateAuthor')
    ->form([
        Select::make('author_id')
            ->label('Auteur')
            ->options(User::query()->pluck('name', 'id'))
            ->required(),
    ])
    ->action(function (array $data, Post $record): void {
        $record->author()->associate($data['author_id']);
        $record->save();
    })
```

### Bulk Actions

```php
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

BulkAction::make('markAsRead')
    ->label('Markeer als gelezen')
    ->icon('heroicon-m-check')
    ->requiresConfirmation()
    ->action(fn (Collection $records) => $records->each->markAsRead())
    ->deselectRecordsAfterCompletion()
```

### Action Modals

```php
Action::make('details')
    ->modalHeading('Details')
    ->modalDescription('Bekijk de details van deze klant')
    ->modalSubmitActionLabel('Sluiten')
    ->modalContent(fn (Customer $record): View => 
        view('filament.components.customer-details', ['customer' => $record])
    )
```

### Action Position

```php
->recordActions([
    EditAction::make(),
], position: ActionsPosition::BeforeCells)
// Of: ActionsPosition::AfterCells (default)
// Of: ActionsPosition::BeforeColumns
// Of: ActionsPosition::AfterColumns
```

---

## Layout

### Column Spans & Alignment

```php
TextColumn::make('name')
    ->columnSpan(2)
    ->alignCenter()
    // Of: alignStart(), alignEnd(), alignJustify()
```

### Split Layout

Verdeel kolommen in meerdere secties:

```php
->columns([
    // Left section
    Tables\Columns\Layout\Split::make([
        TextColumn::make('name'),
        TextColumn::make('email'),
    ]),
    
    // Right section
    Tables\Columns\Layout\Split::make([
        TextColumn::make('phone'),
        TextColumn::make('created_at'),
    ])->grow(false),
])
```

### Stack Layout

Kolommen verticaal stapelen:

```php
use Filament\Tables\Columns\Layout\Stack;

->columns([
    Stack::make([
        TextColumn::make('name')->weight('bold'),
        TextColumn::make('email')->color('gray'),
    ]),
])
```

### Grid Layout

```php
use Filament\Tables\Columns\Layout\Grid;

->columns([
    Grid::make(2)
        ->schema([
            Stack::make([
                TextColumn::make('name'),
                TextColumn::make('email'),
            ]),
            Stack::make([
                TextColumn::make('phone'),
                TextColumn::make('status')->badge(),
            ]),
        ]),
])
```

### Panel Layout

Omring content met een panel:

```php
use Filament\Tables\Columns\Layout\Panel;

->columns([
    TextColumn::make('name'),
    TextColumn::make('email'),
    Panel::make([
        Stack::make([
            TextColumn::make('billing_address')->label('Factuuradres'),
            TextColumn::make('shipping_address')->label('Verzendadres'),
        ]),
    ])->collapsible(),
])
```

---

## Summaries

Aggregaties onderaan kolommen:

```php
use Filament\Tables\Columns\Summarizers\Average;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Range;

TextColumn::make('price')
    ->money('eur')
    ->summarize([
        Average::make()
            ->money('eur')
            ->label('Gemiddeld'),
        Sum::make()
            ->money('eur')
            ->label('Totaal'),
        Range::make()
            ->label('Bereik'),
    ])

TextColumn::make('status')
    ->badge()
    ->summarize([
        Count::make()
            ->label('Totaal aantal'),
    ])
```

### Custom Summarizer

```php
use Filament\Tables\Columns\Summarizers\Summarizer;

TextColumn::make('rating')
    ->summarize(
        Summarizer::make()
            ->label('Hoogste rating')
            ->using(fn ($query) => $query->max('rating'))
    )
```

---

## Grouping

Groepeer rows op basis van een kolom:

```php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('status')
                ->badge(),
            TextColumn::make('name'),
        ])
        ->defaultGroup('status')
        ->groups([
            Group::make('status')
                ->label('Status')
                ->collapsible(),
            Group::make('author.name')
                ->label('Auteur')
                ->titlePrefixedWithLabel(false),
        ])
}
```

### Group Settings

```php
Group::make('status')
    ->collapsible()
    ->collapsed()
    ->titlePrefixedWithLabel(false)
    ->orderQueryUsing(fn (Builder $query, string $direction) => 
        $query->orderBy('status', $direction)
    )
```

---

## Empty State

Customize wat te tonen als table leeg is:

```php
->emptyStateHeading('Geen klanten gevonden')
->emptyStateDescription('Maak je eerste klant aan om te beginnen.')
->emptyStateIcon('heroicon-o-user-group')
->emptyStateActions([
    Action::make('create')
        ->label('Klant aanmaken')
        ->url(CustomerResource::getUrl('create'))
        ->icon('heroicon-m-plus')
        ->button(),
])
```

---

## Advanced

### Search

```php
->searchable() // Op column level

// Global search customization
->globalSearchDebounce('500ms')
->persistSearchInSession()
->persistColumnSearchesInSession()
```

### Polling

Auto-refresh table:

```php
->poll('60s') // Refresh every 60 seconds
```

### Pagination

```php
->paginated([10, 25, 50, 100, 'all'])
->defaultPaginationPageOption(25)
```

### Striped Rows

```php
->striped()
```

### Dense/Comfortable

```php
->dense() // Compactere rows
```

### Selection

```php
->selectCurrentPageOnly() // Alleen huidige pagina selecteerbaar
```

### Reordering

```php
->reorderable('sort_order')
->reorderRecordsTriggerAction(
    fn (Action $action, bool $isReordering) => $action
        ->button()
        ->label($isReordering ? 'Stop sorteren' : 'Sorteer volgorde')
)
```

### Column Searching

```php
TextColumn::make('name')
    ->searchable()
    ->searchDebounce('500ms')
```

### Record URL

```php
->recordUrl(fn (Model $record): string => 
    CustomerResource::getUrl('edit', ['record' => $record])
)
// Of voor custom routing:
->recordUrl(fn (Model $record): string => 
    route('customers.show', ['customer' => $record])
)
```

### Record Classes

```php
->recordClasses(fn (Model $record) => match ($record->status) {
    'published' => 'opacity-30',
    'draft' => 'border-l-2 border-orange-600',
    default => null,
})
```

---

## Pro Tips

### 1. Performance: Eager Loading

```php
// In resource class
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->with(['author', 'category'])
        ->withCount('comments');
}
```

### 2. Scoped Queries Per Table

```php
public static function table(Table $table): Table
{
    return $table
        ->modifyQueryUsing(fn (Builder $query) => 
            $query->where('organization_id', auth()->user()->organization_id)
        );
}
```

### 3. Custom Column State

```php
TextColumn::make('full_name')
    ->getStateUsing(fn (User $record): string => 
        "{$record->first_name} {$record->last_name}"
    )
    ->searchable(query: function (Builder $query, string $search): Builder {
        return $query->where(function (Builder $query) use ($search): void {
            $query->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
        });
    })
```

### 4. Bulk Action Authorization

```php
BulkAction::make('delete')
    ->requiresConfirmation()
    ->action(fn (Collection $records) => $records->each->delete())
    ->deselectRecordsAfterCompletion()
    ->visible(fn (): bool => auth()->user()->can('delete_any_customer'))
```

### 5. Filter Indicators

Laat actieve filters zien:

```php
Filter::make('verified')
    ->query(fn (Builder $query) => $query->whereNotNull('email_verified_at'))
    ->indicateUsing(fn (): Indicator => 
        Indicator::make('Geverifieerd')
            ->removeField('verified')
    )
```

### 6. Computed Columns

```php
TextColumn::make('profit')
    ->getStateUsing(fn ($record) => $record->revenue - $record->costs)
    ->money('eur')
    ->sortable(query: function (Builder $query, string $direction): Builder {
        return $query
            ->selectRaw('(revenue - costs) as profit')
            ->orderBy('profit', $direction);
    })
```

---

## Table Recipe: Advanced Example

```php
use Filament\Tables\Table;

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\Layout\Split::make([
                Tables\Columns\ImageColumn::make('avatar')
                    ->circular()
                    ->size(40),
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('name')
                        ->weight('bold')
                        ->searchable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('email')
                        ->color('gray')
                        ->icon('heroicon-m-envelope')
                        ->searchable(),
                ]),
            ])->grow(),
            Tables\Columns\Layout\Stack::make([
                Tables\Columns\TextColumn::make('organization.name')
                    ->icon('heroicon-m-building-office'),
                Tables\Columns\TextColumn::make('role.name')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'editor' => 'warning',
                        'viewer' => 'success',
                    }),
            ])->alignEnd(),
            Tables\Columns\TextColumn::make('created_at')
                ->date('d-m-Y')
                ->sortable()
                ->toggleable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('role')
                ->relationship('role', 'name')
                ->multiple()
                ->preload(),
            Tables\Filters\TernaryFilter::make('email_verified_at')
                ->label('Email geverifieerd')
                ->nullable()
                ->trueLabel('Geverifieerd')
                ->falseLabel('Niet geverifieerd'),
            Tables\Filters\Filter::make('created_at')
                ->form([
                    Forms\Components\DatePicker::make('created_from')
                        ->label('Aangemaakt vanaf'),
                    Forms\Components\DatePicker::make('created_until')
                        ->label('Aangemaakt tot'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date) => 
                                $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date) => 
                                $query->whereDate('created_at', '<=', $date),
                        );
                }),
        ])
        ->filtersLayout(FiltersLayout::AboveContent)
        ->recordActions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\Action::make('impersonate')
                ->icon('heroicon-m-finger-print')
                ->visible(fn (): bool => auth()->user()->can('impersonate'))
                ->action(function (User $record): void {
                    auth()->user()->impersonate($record);
                    redirect('/dashboard');
                }),
        ])
        ->toolbarActions([
            Tables\Actions\CreateAction::make(),
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('verify')
                    ->label('Verifieer email')
                    ->icon('heroicon-m-check')
                    ->requiresConfirmation()
                    ->action(fn (Collection $records) => 
                        $records->each->markEmailAsVerified()
                    ),
            ]),
        ])
        ->defaultSort('created_at', 'desc')
        ->poll('60s')
        ->striped()
        ->paginated([10, 25, 50, 100])
        ->defaultPaginationPageOption(25)
        ->persistSearchInSession()
        ->persistColumnSearchesInSession();
}
```

---

## Zie Ook

- [Core Documentation](./filament-core.md) - Resources, CRUD, Navigation
- [Forms Documentation](./filament-forms.md) - Form fields voor filters
- [Actions Documentation](./filament-actions.md) - Table actions in detail
