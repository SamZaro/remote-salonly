<?php

namespace App\Filament\Dashboard\Pages;

use App\Settings\BookingSettings;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ManageBookingSettings extends SettingsPage
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 3;

    protected static string $settings = BookingSettings::class;

    public static function getNavigationGroup(): ?string
    {
        return __('Boekingen');
    }

    public static function getNavigationLabel(): string
    {
        return __('Instellingen');
    }

    public function getTitle(): string
    {
        return __('Boeking Instellingen');
    }

    public static function canAccess(): bool
    {
        return \App\Booking\BookingModuleManager::isEnabled()
            && (auth()->user()?->hasPermissionTo('booking.manage') ?? false);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Boekingen Status'))
                    ->description(__('Bepaal of klanten boekingen kunnen maken'))
                    ->schema([
                        Toggle::make('is_active')
                            ->label(__('Boekingen actief'))
                            ->helperText(__('Als dit uit staat, is de boekingspagina niet bereikbaar voor bezoekers'))
                            ->onColor('success')
                            ->offColor('danger'),
                    ]),

                Section::make(__('Tijdslot Instellingen'))
                    ->description(__('Configureer de standaard tijdslot instellingen voor boekingen'))
                    ->schema([
                        Select::make('default_slot_duration')
                            ->label(__('Standaard slot duur'))
                            ->options([
                                15 => '15 minuten',
                                30 => '30 minuten',
                                60 => '60 minuten',
                            ])
                            ->required()
                            ->helperText(__('De standaard duur van een tijdslot in minuten')),
                    ])
                    ->columns(1),

                Section::make(__('Boekingsregels'))
                    ->description(__('Configureer de regels voor wanneer klanten kunnen boeken'))
                    ->schema([
                        TextInput::make('booking_lead_time')
                            ->label(__('Minimale voorsprong (uren)'))
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(168)
                            ->required()
                            ->suffix(__('uren'))
                            ->helperText(__('Hoeveel uur van tevoren moet een boeking minimaal worden gemaakt')),

                        TextInput::make('max_advance_booking_days')
                            ->label(__('Maximum aantal dagen vooruit'))
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(365)
                            ->required()
                            ->suffix(__('dagen'))
                            ->helperText(__('Hoeveel dagen van tevoren kan een klant maximaal boeken')),
                    ])
                    ->columns(2),
            ]);
    }

    protected function afterSave(): void
    {
        Notification::make()
            ->title(__('Instellingen opgeslagen'))
            ->success()
            ->send();
    }
}
