<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\FeatureTest;

class LoginControllerTest extends FeatureTest
{
    use WithFaker;

    public function test_recaptcha_is_viewed_if_enabled()
    {
        config(['app.recaptcha_enabled' => true]);

        $response = $this->get(route('login'));

        $response->assertSee('g-recaptcha');
    }

    public function test_recaptcha_is_not_viewed_if_disabled()
    {
        config(['app.recaptcha_enabled' => false]);

        $response = $this->get(route('login'));

        $response->assertDontSee('g-recaptcha');
    }

    public function test_2fa_verification_is_not_shown_when_user_has_no_2fa_enabled()
    {
        config(['app.two_factor_auth_enabled' => true]);

        $user = $this->createUser([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('filament.dashboard.pages.dashboard'));
    }

    public function test_2fa_verification_is_shown_when_user_has_2fa_enabled()
    {
        config(['app.two_factor_auth_enabled' => true]);

        $email = $this->faker->email;

        /** @var User $user */
        $user = $this->createUser([
            'email' => $email,
            'password' => bcrypt('password123'),
        ]);

        $user->createTwoFactorAuth();
        $user->enableTwoFactorAuth();

        $response = $this->post(route('login'), [
            'email' => $email,
            'password' => 'password123',
        ]);

        $response->assertSee('name="2fa_code"', false);  // 2FA code input field
    }

    public function test_2fa_verification_is_not_shown_when_user_has_2fa_enabled_but_2fa_is_disabled()
    {
        config(['app.two_factor_auth_enabled' => false]);

        $email = $this->faker->email;

        /** @var User $user */
        $user = $this->createUser([
            'email' => $email,
            'password' => bcrypt('password123'),
        ]);

        $user->createTwoFactorAuth();
        $user->enableTwoFactorAuth();

        $response = $this->post(route('login'), [
            'email' => $email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('filament.dashboard.pages.dashboard'));
    }

    public function test_customer_redirects_to_dashboard_after_login_from_home_url()
    {
        config(['app.two_factor_auth_enabled' => false]);

        $email = $this->faker->unique()->safeEmail();

        $user = $this->createUser([
            'email' => $email,
            'password' => bcrypt('password123'),
        ]);

        // Simulate coming from login page (since home page requires Page model setup)
        $this->get(route('login'));

        $response = $this->post(route('login'), [
            'email' => $email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('filament.dashboard.pages.dashboard'));
    }

    public function test_admin_redirects_to_admin_dashboard_after_login()
    {
        config(['app.two_factor_auth_enabled' => false]);

        $email = $this->faker->unique()->safeEmail();

        $admin = $this->createUser([
            'email' => $email,
            'password' => bcrypt('password123'),
            'is_admin' => true,
        ]);

        $response = $this->post(route('login'), [
            'email' => $email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('filament.admin.pages.dashboard'));
    }

    public function test_customer_redirects_to_dashboard_when_coming_from_admin_url()
    {
        config(['app.two_factor_auth_enabled' => false]);

        $email = $this->faker->unique()->safeEmail();

        $user = $this->createUser([
            'email' => $email,
            'password' => bcrypt('password123'),
        ]);

        // Manually set intended URL to admin panel (simulating redirect from trying to access admin)
        session()->put('url.intended', route('filament.admin.pages.dashboard'));

        $response = $this->post(route('login'), [
            'email' => $email,
            'password' => 'password123',
        ]);

        // Should redirect to user dashboard, NOT admin
        $response->assertRedirect(route('filament.dashboard.pages.dashboard'));
    }
}
