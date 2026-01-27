<?php

namespace Tests\Feature\Filament\Dashboard\Widgets;

use App\Filament\Dashboard\Widgets\EmailConfigurationAlert;
use App\Models\Config;
use App\Models\User;
use Tests\Feature\FeatureTest;

class EmailConfigurationAlertTest extends FeatureTest
{
    public function test_widget_is_visible_for_customer_without_email_config(): void
    {
        $user = $this->createCustomerUser();
        $this->actingAs($user);

        // Ensure no email config in database
        Config::where('key', 'like', 'mail.%')->delete();
        Config::where('key', 'like', 'services.%')->delete();

        $this->assertTrue(EmailConfigurationAlert::canView());
    }

    public function test_widget_is_hidden_when_smtp_config_exists(): void
    {
        $user = $this->createCustomerUser();
        $this->actingAs($user);

        // Add SMTP config to database
        Config::set('mail.mailers.smtp.host', 'smtp.example.com');

        $this->assertFalse(EmailConfigurationAlert::canView());

        // Cleanup
        Config::where('key', 'mail.mailers.smtp.host')->delete();
    }

    public function test_widget_is_hidden_for_user_without_permission(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->assertFalse(EmailConfigurationAlert::canView());
    }

    public function test_widget_is_hidden_when_mailgun_config_exists(): void
    {
        $user = $this->createCustomerUser();
        $this->actingAs($user);

        // Add Mailgun config to database
        Config::set('services.mailgun.secret', 'test-secret');

        $this->assertFalse(EmailConfigurationAlert::canView());

        // Cleanup
        Config::where('key', 'services.mailgun.secret')->delete();
    }

    public function test_has_email_configuration_returns_false_when_no_config(): void
    {
        // Ensure no email config in database
        Config::where('key', 'like', 'mail.%')->delete();
        Config::where('key', 'like', 'services.%')->delete();

        $this->assertFalse(EmailConfigurationAlert::hasEmailConfiguration());
    }

    public function test_has_email_configuration_returns_true_with_smtp_host(): void
    {
        Config::set('mail.mailers.smtp.host', 'smtp.example.com');

        $this->assertTrue(EmailConfigurationAlert::hasEmailConfiguration());

        // Cleanup
        Config::where('key', 'mail.mailers.smtp.host')->delete();
    }

    protected function createCustomerUser(): User
    {
        $user = User::factory()->create();
        $user->assignRole('customer');

        return $user;
    }
}
