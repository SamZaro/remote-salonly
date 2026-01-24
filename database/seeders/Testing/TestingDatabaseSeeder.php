<?php

namespace Database\Seeders\Testing;

use Database\Seeders\RolesAndPermissionsSeeder;
use Database\Seeders\SiteSettingsSeeder;
use Database\Seeders\VerificationProvidersSeeder;
use Illuminate\Database\Seeder;

class TestingDatabaseSeeder extends Seeder
{
    /**
     * Seed the testing database.
     */
    public function run(): void
    {
        // run only in testing environment
        if (app()->environment() !== 'testing') {
            return;
        }

        $this->callOnce([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            VerificationProvidersSeeder::class,
            SiteSettingsSeeder::class,
        ]);
    }
}
