<?php

namespace Database\Seeders;

use App\Models\BusinessHours;
use Illuminate\Database\Seeder;

class BusinessHoursSeeder extends Seeder
{
    public function run(): void
    {
        $days = [
            0 => ['name' => 'Zondag', 'is_open' => false],
            1 => ['name' => 'Maandag', 'is_open' => true],
            2 => ['name' => 'Dinsdag', 'is_open' => true],
            3 => ['name' => 'Woensdag', 'is_open' => true],
            4 => ['name' => 'Donderdag', 'is_open' => true],
            5 => ['name' => 'Vrijdag', 'is_open' => true],
            6 => ['name' => 'Zaterdag', 'is_open' => false],
        ];

        foreach ($days as $dayOfWeek => $config) {
            BusinessHours::updateOrCreate(
                ['day_of_week' => $dayOfWeek],
                [
                    'open_time' => '09:00',
                    'close_time' => '17:00',
                    'is_open' => $config['is_open'],
                    'slot_duration' => 30,
                ]
            );
        }
    }
}
