<?php

namespace App\Filament\Admin\Resources\BusinessHours;

use App\Filament\Admin\Resources\BusinessHours\Pages\ListBusinessHours;
use App\Models\BusinessHours;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class BusinessHoursResource extends Resource
{
    protected static ?string $model = BusinessHours::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clock';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('Boekingen');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Openingstijden');
    }

    public static function getModelLabel(): string
    {
        return __('Openingstijd');
    }

    public static function getNavigationLabel(): string
    {
        return __('Openingstijden');
    }

    public static function canCreate(): bool
    {
        return false; // Days are seeded, no need to create new ones
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasPermissionTo('availability.view') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('day_of_week')
                    ->label(__('Dag'))
                    ->options([
                        0 => __('Zondag'),
                        1 => __('Maandag'),
                        2 => __('Dinsdag'),
                        3 => __('Woensdag'),
                        4 => __('Donderdag'),
                        5 => __('Vrijdag'),
                        6 => __('Zaterdag'),
                    ])
                    ->disabled()
                    ->required(),
                TimePicker::make('open_time')
                    ->label(__('Openingstijd'))
                    ->seconds(false)
                    ->required(),
                TimePicker::make('close_time')
                    ->label(__('Sluitingstijd'))
                    ->seconds(false)
                    ->required(),
                Toggle::make('is_open')
                    ->label(__('Geopend'))
                    ->default(true),
                Select::make('slot_duration')
                    ->label(__('Slot duur'))
                    ->options([
                        15 => '15 minuten',
                        30 => '30 minuten',
                        60 => '60 minuten',
                    ])
                    ->default(30)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('day_name')
                    ->label(__('Dag'))
                    ->sortable(query: fn ($query, $direction) => $query->orderBy('day_of_week', $direction)),
                TextInputColumn::make('open_time')
                    ->label(__('Openingstijd'))
                    ->type('time')
                    ->rules(['required', 'date_format:H:i'])
                    ->disabled(fn () => ! auth()->user()?->hasPermissionTo('availability.manage')),
                TextInputColumn::make('close_time')
                    ->label(__('Sluitingstijd'))
                    ->type('time')
                    ->rules(['required', 'date_format:H:i'])
                    ->disabled(fn () => ! auth()->user()?->hasPermissionTo('availability.manage')),
                ToggleColumn::make('is_open')
                    ->label(__('Geopend'))
                    ->disabled(fn () => ! auth()->user()?->hasPermissionTo('availability.manage')),
                SelectColumn::make('slot_duration')
                    ->label(__('Slot duur'))
                    ->options([
                        15 => '15 min',
                        30 => '30 min',
                        60 => '60 min',
                    ])
                    ->disabled(fn () => ! auth()->user()?->hasPermissionTo('availability.manage')),
            ])
            ->filters([])
            ->recordActions([])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('day_of_week', 'asc')
            ->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBusinessHours::route('/'),
        ];
    }
}
