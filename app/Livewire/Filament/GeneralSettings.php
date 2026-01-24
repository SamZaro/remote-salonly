<?php

namespace App\Livewire\Filament;

use App\Models\EmailProvider;
use App\Models\VerificationProvider;
use App\Services\ConfigService;
use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class GeneralSettings extends Component implements HasForms
{
    use InteractsWithForms;

    private ConfigService $configService;

    public ?array $data = [];

    public function render()
    {
        return view('livewire.filament.general-settings');
    }

    public function boot(ConfigService $configService): void
    {
        $this->configService = $configService;
    }

    public function mount(): void
    {
        $this->form->fill([
            'site_name' => $this->configService->get('app.name'),
            'description' => $this->configService->get('app.description'),
            'support_email' => $this->configService->get('app.support_email'),
            'date_format' => $this->configService->get('app.date_format'),
            'datetime_format' => $this->configService->get('app.datetime_format'),
            'google_tracking_id' => $this->configService->get('app.google_tracking_id'),
            'tracking_scripts' => $this->configService->get('app.tracking_scripts'),
            'default_email_provider' => $this->configService->get('mail.default'),
            'default_email_from_name' => $this->configService->get('mail.from.name'),
            'default_email_from_email' => $this->configService->get('mail.from.address'),
            'social_links_facebook' => $this->configService->get('app.social_links.facebook') ?? '',
            'social_links_x' => $this->configService->get('app.social_links.x') ?? '',
            'social_links_linkedin' => $this->configService->get('app.social_links.linkedin-openid') ?? '',
            'social_links_instagram' => $this->configService->get('app.social_links.instagram') ?? '',
            'social_links_youtube' => $this->configService->get('app.social_links.youtube') ?? '',
            'social_links_github' => $this->configService->get('app.social_links.github') ?? '',
            'social_links_discord' => $this->configService->get('app.social_links.discord') ?? '',
            'recaptcha_enabled' => $this->configService->get('app.recaptcha_enabled', false),
            'recaptcha_api_site_key' => $this->configService->get('recaptcha.api_site_key', ''),
            'recaptcha_api_secret_key' => $this->configService->get('recaptcha.api_secret_key', ''),
            'otp_login_enabled' => $this->configService->get('app.otp_login_enabled', false),
            'cookie_consent_enabled' => $this->configService->get('cookie-consent.enabled', false),
            'two_factor_auth_enabled' => $this->configService->get('app.two_factor_auth_enabled', false),
            'default_verification_provider' => $this->configService->get('app.verification.default_provider'),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()->tabs([
                    Tab::make(__('Application'))
                        ->icon('heroicon-o-globe-alt')
                        ->schema([
                            TextInput::make('site_name')
                                ->label(__('Site Name'))
                                ->required(),
                            Textarea::make('description')
                                ->helperText(__('This will be used as the meta description for your site (for pages that have no description).')),
                            TextInput::make('support_email')
                                ->label(__('Support Email'))
                                ->required()
                                ->email(),
                            TextInput::make('date_format')
                                ->label(__('Date Format'))
                                ->rules([
                                    function () {
                                        return function (string $attribute, $value, Closure $fail) {
                                            $timestamp = strtotime('2021-01-01');
                                            $date = date($value, $timestamp);

                                            if ($date === false) {
                                                $fail(__('The :attribute is invalid.'));
                                            }
                                        };
                                    },
                                ])
                                ->required(),
                            TextInput::make('datetime_format')
                                ->label(__('Date Time Format'))
                                ->rules([
                                    function () {
                                        return function (string $attribute, $value, Closure $fail) {
                                            $timestamp = strtotime('2021-01-01 00:00:00');
                                            $date = date($value, $timestamp);

                                            if ($date === false) {
                                                $fail(__('The :attribute is invalid.'));
                                            }
                                        };
                                    },
                                ])
                                ->required(),
                        ]),
                    Tab::make(__('Email'))
                        ->icon('heroicon-o-envelope')
                        ->schema([
                            Select::make('default_email_provider')
                                ->label(__('Default Email Provider'))
                                ->options(function () {
                                    $providers = [
                                        'smtp' => 'SMTP',
                                    ];

                                    foreach (EmailProvider::all() as $provider) {
                                        $providers[$provider->slug] = $provider->name;
                                    }

                                    return $providers;
                                })
                                ->helperText(__('This is the email provider that will be used for all emails.'))
                                ->required()
                                ->searchable(),
                            TextInput::make('default_email_from_name')
                                ->label(__('Default "From" Email Name'))
                                ->helperText(__('This is the name that will be used as the "From" name for all emails.'))
                                ->required(),
                            TextInput::make('default_email_from_email')
                                ->label(__('Default "From" Email Address'))
                                ->helperText(__('This is the email address that will be used as the "From" address for all emails.'))
                                ->required()
                                ->email(),
                        ]),
                    Tab::make(__('Verification'))
                        ->icon('heroicon-o-chat-bubble-oval-left-ellipsis')
                        ->schema([
                            Select::make('default_verification_provider')
                                ->label(__('Default Verification Provider'))
                                ->options(function () {
                                    $providers = [];

                                    foreach (VerificationProvider::all() as $provider) {
                                        $providers[$provider->slug] = $provider->name;
                                    }

                                    return $providers;
                                })
                                ->helperText(__('This is the verification provider that will be used for all user phone SMS verifications.'))
                                ->required()
                                ->searchable(),
                        ]),
                    Tab::make(__('Analytics & Cookies'))
                        ->icon('heroicon-o-squares-2x2')
                        ->schema([
                            Toggle::make('cookie_consent_enabled')
                                ->label(__('Cookie Consent Bar Enabled'))
                                ->helperText(__('If enabled, the cookie consent bar will be shown to users.')),
                            TextInput::make('google_tracking_id')
                                ->helperText(__('Google analytics will only be inserted if either "Cookie Consent Bar" is disabled or in case user has consented to cookies.'))
                                ->label(__('Google Tracking ID')),
                            Textarea::make('tracking_scripts')
                                ->helperText(__('Paste in any other analytics or tracking scripts here. Those scripts will only be inserted if either "Cookie Consent Bar" is disabled or in case user has consented to cookies.'))
                                ->label(__('Other Tracking Scripts')),
                        ]),
                    Tab::make(__('Authentication & Security'))
                        ->icon('heroicon-c-shield-check')
                        ->schema([
                            Section::make()
                                ->schema([
                                    Toggle::make('two_factor_auth_enabled')
                                        ->label(__('Two Factor Authentication Enabled'))
                                        ->helperText(__('If enabled, users will be able to enable two factor authentication on their account. If disabled, the 2FA field will not be shown on the login form even for users who have it enabled.'))
                                        ->required(),
                                ]),
                            Section::make()
                                ->schema([
                                    Toggle::make('otp_login_enabled')
                                        ->label(__('One-Time Password Login Enabled'))
                                        ->helperText(__('If enabled, checkout forms will use one-time passwords sent via email instead of traditional passwords for login and registration.'))
                                        ->required(),
                                ]),
                            Section::make()
                                ->schema([
                                    Toggle::make('recaptcha_enabled')
                                        ->label(__('Recaptcha Enabled'))
                                        ->helperText(new HtmlString(__('If enabled, recaptcha will be used on the registration & login forms. For more info on how to configure Recaptcha, see the <a class="text-primary-500" href=":url" target="_blank">documentation</a>.', ['url' => 'https://saasykit.com/docs/recaptcha'])))
                                        ->required(),
                                    TextInput::make('recaptcha_api_site_key')
                                        ->label(__('Recaptcha Site Key')),
                                    TextInput::make('recaptcha_api_secret_key')
                                        ->label(__('Recaptcha Secret Key')),
                                ]),
                        ]),
                    Tab::make(__('Social Links'))
                        ->icon('heroicon-o-heart')
                        ->schema([
                            TextInput::make('social_links_facebook')
                                ->label(__('Facebook')),
                            TextInput::make('social_links_x')
                                ->label(__('X (Twitter)')),
                            TextInput::make('social_links_linkedin')
                                ->label(__('LinkedIn')),
                            TextInput::make('social_links_instagram')
                                ->label(__('Instagram')),
                            TextInput::make('social_links_youtube')
                                ->label(__('YouTube')),
                            TextInput::make('social_links_github')
                                ->label(__('GitHub')),
                            TextInput::make('social_links_discord')
                                ->label(__('Discord')),
                        ]),
                ])
                    ->persistTabInQueryString('settings-tab'),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->configService->set('app.name', $data['site_name']);
        $this->configService->set('app.description', $data['description']);
        $this->configService->set('app.support_email', $data['support_email']);
        $this->configService->set('app.date_format', $data['date_format']);
        $this->configService->set('app.datetime_format', $data['datetime_format']);
        $this->configService->set('app.google_tracking_id', $data['google_tracking_id'] ?? '');
        $this->configService->set('app.tracking_scripts', $data['tracking_scripts'] ?? '');
        $this->configService->set('mail.default', $data['default_email_provider']);
        $this->configService->set('mail.from.name', $data['default_email_from_name']);
        $this->configService->set('mail.from.address', $data['default_email_from_email']);
        $this->configService->set('app.social_links.facebook', $data['social_links_facebook']);
        $this->configService->set('app.social_links.x', $data['social_links_x']);
        $this->configService->set('app.social_links.linkedin-openid', $data['social_links_linkedin']);
        $this->configService->set('app.social_links.instagram', $data['social_links_instagram']);
        $this->configService->set('app.social_links.youtube', $data['social_links_youtube']);
        $this->configService->set('app.social_links.github', $data['social_links_github']);
        $this->configService->set('app.social_links.discord', $data['social_links_discord']);
        $this->configService->set('app.recaptcha_enabled', $data['recaptcha_enabled']);
        $this->configService->set('recaptcha.api_site_key', $data['recaptcha_api_site_key']);
        $this->configService->set('recaptcha.api_secret_key', $data['recaptcha_api_secret_key']);
        $this->configService->set('cookie-consent.enabled', $data['cookie_consent_enabled']);
        $this->configService->set('app.two_factor_auth_enabled', $data['two_factor_auth_enabled']);
        $this->configService->set('app.otp_login_enabled', $data['otp_login_enabled']);
        $this->configService->set('app.verification.default_provider', $data['default_verification_provider']);

        Notification::make()
            ->title(__('Settings Saved'))
            ->success()
            ->send();
    }
}
