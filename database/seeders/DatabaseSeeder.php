<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->callOnce([
            OAuthLoginProvidersSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            EmailProvidersSeeder::class,
            VerificationProvidersSeeder::class,
            SiteSettingsSeeder::class,
            CategorySeeder::class,
            TemplateSeeder::class,
            BookingPermissionsSeeder::class,
            BusinessHoursSeeder::class
        ]);
    }
}
