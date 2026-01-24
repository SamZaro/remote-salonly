<?php

namespace App\Filament\Admin\Resources\AvailabilityExceptions;

use App\Filament\Admin\Resources\AvailabilityExceptions\Pages\CreateAvailabilityException;
use App\Filament\Admin\Resources\AvailabilityExceptions\Pages\EditAvailabilityException;
use App\Filament\Admin\Resources\AvailabilityExceptions\Pages\ListAvailabilityExceptions;
use App\Models\AvailabilityException;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AvailabilityExceptionResource extends Resource
{
    protected static ?string $model = AvailabilityException::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('Boekingen');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Uitzonderingen');
    }

    public static function getModelLabel(): string
    {
        return __('Uitzondering');
    }

    public static function getNavigationLabel(): string
    {
        return __('Uitzonderingen');
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasPermissionTo('availability.view') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->hasPermissionTo('availability.manage') ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->hasPermissionTo('availability.manage') ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->hasPermissionTo('availability.manage') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->label(__('Datum'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->minDate(now())
                    ->native(false)
                    ->displayFormat('d-m-Y'),
                Toggle::make('is_available')
                    ->label(__('Beschikbaar'))
                    ->helperText(__('Schakel in als deze dag beschikbaar is met aangepaste tijden'))
                    ->default(false)
                    ->live(),
                TimePicker::make('custom_open_time')
                    ->label(__('Aangepaste openingstijd'))
                    ->seconds(false)
                    ->visible(fn ($get) => $get('is_available')),
                TimePicker::make('custom_close_time')
                    ->label(__('Aangepaste sluitingstijd'))
                    ->seconds(false)
                    ->visible(fn ($get) => $get('is_available')),
                TextInput::make('reason')
                    ->label(__('Reden'))
                    ->maxLength(255)
                    ->helperText(__('Bijv. Feestdag, Vakantie, Verbouwing')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->label(__('Datum'))
                    ->date('d-m-Y')
                    ->sortable(),
                IconColumn::make('is_available')
                    ->label(__('Beschikbaar'))
                    ->boolean(),
                TextColumn::make('custom_open_time')
                    ->label(__('Openingstijd'))
                    ->placeholder('-'),
                TextColumn::make('custom_close_time')
                    ->label(__('Sluitingstijd'))
                    ->placeholder('-'),
                TextColumn::make('reason')
                    ->label(__('Reden'))
                    ->limit(30)
                    ->placeholder('-'),
                TextColumn::make('created_at')
                    ->label(__('Aangemaakt'))
                    ->dateTime(config('app.datetime_format'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('upcoming')
                    ->label(__('Komende'))
                    ->query(fn (Builder $query) => $query->where('date', '>=', now()))
                    ->default(),
                Filter::make('closed')
                    ->label(__('Gesloten dagen'))
                    ->query(fn (Builder $query) => $query->where('is_available', false)),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAvailabilityExceptions::route('/'),
            'create' => CreateAvailabilityException::route('/create'),
            'edit' => EditAvailabilityException::route('/{record}/edit'),
        ];
    }
}
