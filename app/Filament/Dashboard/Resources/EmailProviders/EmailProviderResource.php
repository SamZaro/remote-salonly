<?php

namespace App\Filament\Dashboard\Resources\EmailProviders;

use App\Filament\Dashboard\Resources\EmailProviders\Pages\AmazonSesSettings;
use App\Filament\Dashboard\Resources\EmailProviders\Pages\EditEmailProvider;
use App\Filament\Dashboard\Resources\EmailProviders\Pages\ListEmailProviders;
use App\Filament\Dashboard\Resources\EmailProviders\Pages\MailgunSettings;
use App\Filament\Dashboard\Resources\EmailProviders\Pages\PostmarkSettings;
use App\Filament\Dashboard\Resources\EmailProviders\Pages\ResendSettings;
use App\Filament\Dashboard\Resources\EmailProviders\Pages\SmtpSettings;
use App\Models\EmailProvider;
use App\Services\ConfigService;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class EmailProviderResource extends Resource
{
    protected static ?string $model = EmailProvider::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    protected static ?int $navigationSort = 100;

    public static function getNavigationGroup(): ?string
    {
        return __('Instellingen');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Email Providers');
    }

    public static function getModelLabel(): string
    {
        return __('Email Provider');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('name')
                        ->required()
                        ->label(__('Name'))
                        ->maxLength(255),
                    TextInput::make('slug')
                        ->required()
                        ->readOnly()
                        ->label(__('Slug'))
                        ->maxLength(255),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->getStateUsing(function (EmailProvider $record) {
                        return new HtmlString(
                            '<div class="flex gap-2">'.
                            ' <img src="'.asset('images/email-providers/'.$record->slug.'.svg').'" alt="'.__('Provider Name').'" class="h-6"> '
                            .$record->name
                            .'</div>'
                        );
                    }),
                TextColumn::make('slug')
                    ->label(__('Slug'))
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmailProviders::route('/'),
            'edit' => EditEmailProvider::route('/{record}/edit'),
            'mailgun-settings' => MailgunSettings::route('/mailgun-settings'),
            'postmark-settings' => PostmarkSettings::route('/postmark-settings'),
            'ses-settings' => AmazonSesSettings::route('/ses-settings'),
            'resend-settings' => ResendSettings::route('/resend-settings'),
            'smtp-settings' => SmtpSettings::route('/smtp-settings'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function canAccess(): bool
    {
        $configService = app()->make(ConfigService::class);

        return $configService->isAdminSettingsEnabled()
            && auth()->user()
            && auth()->user()->hasPermissionTo('manage email providers');
    }

    public static function getNavigationLabel(): string
    {
        return __('Email Providers');
    }
}
