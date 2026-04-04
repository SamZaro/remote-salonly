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
        return __('Bookings');
    }

    public static function getNavigationLabel(): string
    {
        return __('Settings');
    }

    public function getTitle(): string
    {
        return __('Booking Settings');
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
                Section::make(__('Booking Status'))
                    ->description(__('Determine whether customers can make bookings'))
                    ->schema([
                        Toggle::make('is_active')
                            ->label(__('Bookings Active'))
                            ->helperText(__('When disabled, the booking page is not accessible to visitors'))
                            ->onColor('success')
                            ->offColor('danger'),
                    ]),

                Section::make(__('Time Slot Settings'))
                    ->description(__('Configure the default time slot settings for bookings'))
                    ->schema([
                        Select::make('default_slot_duration')
                            ->label(__('Default Slot Duration'))
                            ->options([
                                15 => __(':count minutes', ['count' => 15]),
                                30 => __(':count minutes', ['count' => 30]),
                                60 => __(':count minutes', ['count' => 60]),
                            ])
                            ->required()
                            ->helperText(__('The default duration of a time slot in minutes')),
                    ])
                    ->columns(1),

                Section::make(__('Booking Rules'))
                    ->description(__('Configure the rules for when customers can book'))
                    ->schema([
                        TextInput::make('booking_lead_time')
                            ->label(__('Minimum Lead Time (hours)'))
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(168)
                            ->required()
                            ->suffix(__('hours'))
                            ->helperText(__('How many hours in advance a booking must be made')),

                        TextInput::make('max_advance_booking_days')
                            ->label(__('Maximum Advance Booking Days'))
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(365)
                            ->required()
                            ->suffix(__('days'))
                            ->helperText(__('How many days in advance a customer can book')),
                    ])
                    ->columns(2),
            ]);
    }

    protected function afterSave(): void
    {
        Notification::make()
            ->title(__('Settings saved'))
            ->success()
            ->send();
    }
}
