<?php

namespace App\Filament\Dashboard\Widgets;

use App\Filament\Dashboard\Resources\EmailProviders\EmailProviderResource;
use App\Models\Config;
use Filament\Widgets\Widget;

class EmailConfigurationAlert extends Widget
{
    protected string $view = 'filament.dashboard.widgets.email-configuration-alert';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = -10;

    public static function canView(): bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        // Only show to users who can manage email providers
        if (! $user->hasPermissionTo('manage email providers')) {
            return false;
        }

        // Only show if EmailProviderResource is accessible
        if (! EmailProviderResource::canAccess()) {
            return false;
        }

        // Only show if no email configuration exists in database
        return ! static::hasEmailConfiguration();
    }

    public static function hasEmailConfiguration(): bool
    {
        // Check if any mail configuration is stored in the database
        $mailConfigs = [
            'mail.mailers.smtp.host',
            'mail.mailers.smtp.username',
            'services.ses.key',
            'services.mailgun.secret',
            'services.postmark.token',
            'services.resend.key',
        ];

        foreach ($mailConfigs as $key) {
            if (Config::get($key)) {
                return true;
            }
        }

        return false;
    }

    public function getEmailProvidersUrl(): string
    {
        return EmailProviderResource::getUrl('index');
    }
}
