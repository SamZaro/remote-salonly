<?php

namespace Database\Seeders;

use App\Settings\SiteSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if settings already exist
        $existingSettings = DB::table('settings')
            ->where('group', 'site')
            ->count();

        if ($existingSettings > 0) {
            $this->command->info('Site settings already exist, skipping...');
            return;
        }

        // Initialize settings using the settings table directly
        DB::table('settings')->insert([
            [
                'group' => 'site',
                'name' => 'site_name',
                'locked' => false,
                'payload' => json_encode('Oasis Templator'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'site',
                'name' => 'logo',
                'locked' => false,
                'payload' => json_encode(null),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'site',
                'name' => 'template_slug',
                'locked' => false,
                'payload' => json_encode('shadow'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'site',
                'name' => 'template_config',
                'locked' => false,
                'payload' => json_encode([
                    'colors' => [
                        'primary' => '#10b981',
                        'secondary' => '#3b82f6',
                    ],
                    'typography' => [
                        'font_family' => 'Inter',
                    ],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('Site settings seeded successfully!');
    }
}
