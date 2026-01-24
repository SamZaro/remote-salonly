<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding template categories...');

        $categories = [
            [
                'name' => 'Kappers',
                'slug' => 'kappers',
                'description' => 'Templates voor kapperszaken, barbershops en haarsalons.',
                'icon' => 'heroicon-o-scissors',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Zakelijk',
                'slug' => 'zakelijk',
                'description' => 'Professionele templates voor zakelijke dienstverlening.',
                'icon' => 'heroicon-o-building-office',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Horeca',
                'slug' => 'horeca',
                'description' => 'Templates voor restaurants, cafés en horecabedrijven.',
                'icon' => 'heroicon-o-building-storefront',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Automotive',
                'slug' => 'automotive',
                'description' => 'Templates voor garages, autobedrijven en dealers.',
                'icon' => 'heroicon-o-truck',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
            $this->command->info("  ✓ Category '{$data['name']}' created/updated");
        }

        $this->command->info('Categories seeded successfully!');
    }
}
