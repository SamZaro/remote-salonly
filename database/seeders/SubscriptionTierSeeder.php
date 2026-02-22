<?php

namespace Database\Seeders;

use App\Models\Template;
use App\Models\User;
use App\Settings\BookingSettings;
use App\Settings\ContactFormSettings;
use App\Settings\SiteSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SubscriptionTierSeeder extends Seeder
{
    /**
     * Simulate a full provisioning flow: customer user, template, and module flags.
     *
     * Usage: php artisan db:seed --class=SubscriptionTierSeeder
     */
    public function run(): void
    {
        // 1. Kies template
        $templates = Template::where('is_active', true)
            ->orderBy('name')
            ->pluck('name', 'slug')
            ->toArray();

        $templateName = $this->command->choice(
            'Welk template wil je gebruiken?',
            array_values($templates),
            array_search('Shadow', $templates) !== false ? 'Shadow' : null,
        );

        $templateSlug = array_search($templateName, $templates);

        // 2. Kies abonnement
        $tier = $this->command->choice(
            'Welk abonnement wil je simuleren?',
            ['starter', 'pro', 'premium'],
            'starter'
        );

        // 3. Maak customer user aan
        $user = User::updateOrCreate(
            ['email' => 'customer@test.com'],
            [
                'name' => 'Test Customer',
                'password' => Hash::make('password'),
            ]
        );

        $user->syncRoles(['customer']);

        // 4. Stel template in via SiteSettings
        $siteSettings = app(SiteSettings::class);
        $siteSettings->template_slug = $templateSlug;
        $siteSettings->save();

        // 5. Zet module flags op basis van tier
        $modules = match ($tier) {
            'starter' => ['booking' => false, 'contact' => false],
            'pro' => ['booking' => false, 'contact' => true],
            'premium' => ['booking' => true, 'contact' => true],
        };

        $bookingSettings = app(BookingSettings::class);
        $bookingSettings->is_active = $modules['booking'];
        $bookingSettings->save();

        $contactFormSettings = app(ContactFormSettings::class);
        $contactFormSettings->is_active = $modules['contact'];
        $contactFormSettings->save();

        // 6. Clear cache
        $this->command->call('optimize:clear');

        // 7. Overzicht
        $this->command->newLine();
        $this->command->info("Provisioning gesimuleerd voor customer@test.com");
        $this->command->table(
            ['Instelling', 'Waarde'],
            [
                ['Template', "{$templateName} ({$templateSlug})"],
                ['Abonnement', ucfirst($tier)],
                ['Booking Widget', $modules['booking'] ? 'Actief' : 'Inactief'],
                ['Contact Formulier', $modules['contact'] ? 'Actief' : 'Inactief'],
            ]
        );
    }
}
