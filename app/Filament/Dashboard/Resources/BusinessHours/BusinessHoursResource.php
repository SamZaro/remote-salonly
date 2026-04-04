<?php

namespace App\Filament\Dashboard\Resources\BusinessHours;

use App\Filament\Dashboard\Resources\BusinessHours\Pages\ListBusinessHours;
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
        return __('Bookings');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Business Hours');
    }

    public static function getModelLabel(): string
    {
        return __('Business Hour');
    }

    public static function getNavigationLabel(): string
    {
        return __('Business Hours');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canAccess(): bool
    {
        return \App\Booking\BookingModuleManager::isEnabled()
            && (auth()->user()?->hasPermissionTo('availability.view') ?? false);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('day_of_week')
                    ->label(__('Day'))
                    ->options([
                        0 => __('Sunday'),
                        1 => __('Monday'),
                        2 => __('Tuesday'),
                        3 => __('Wednesday'),
                        4 => __('Thursday'),
                        5 => __('Friday'),
                        6 => __('Saturday'),
                    ])
                    ->disabled()
                    ->required(),
                TimePicker::make('open_time')
                    ->label(__('Opening Time'))
                    ->seconds(false)
                    ->required(),
                TimePicker::make('close_time')
                    ->label(__('Closing Time'))
                    ->seconds(false)
                    ->required(),
                Toggle::make('is_open')
                    ->label(__('Open'))
                    ->default(true),
                Select::make('slot_duration')
                    ->label(__('Slot Duration'))
                    ->options([
                        15 => __(':count minutes', ['count' => 15]),
                        30 => __(':count minutes', ['count' => 30]),
                        60 => __(':count minutes', ['count' => 60]),
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
                    ->label(__('Day'))
                    ->sortable(query: fn ($query, $direction) => $query->orderBy('day_of_week', $direction)),
                TextInputColumn::make('open_time')
                    ->label(__('Opening Time'))
                    ->type('time')
                    ->rules(['required', 'date_format:H:i'])
                    ->disabled(fn () => ! auth()->user()?->hasPermissionTo('availability.manage')),
                TextInputColumn::make('close_time')
                    ->label(__('Closing Time'))
                    ->type('time')
                    ->rules(['required', 'date_format:H:i'])
                    ->disabled(fn () => ! auth()->user()?->hasPermissionTo('availability.manage')),
                ToggleColumn::make('is_open')
                    ->label(__('Open'))
                    ->disabled(fn () => ! auth()->user()?->hasPermissionTo('availability.manage')),
                SelectColumn::make('slot_duration')
                    ->label(__('Slot Duration'))
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
