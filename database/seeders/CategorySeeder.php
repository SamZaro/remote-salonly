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
                'name' => 'Kapsalons',
                'slug' => 'kapsalons',
                'description' => 'Templates voor kapsalons en haarsalons.',
                'icon' => 'heroicon-o-scissors',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Barbershops',
                'slug' => 'barbershops',
                'description' => 'Templates voor barbershops en herenkapsalons.',
                'icon' => 'heroicon-o-scissors',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Schoonheidssalons',
                'slug' => 'schoonheidssalons',
                'description' => 'Templates voor schoonheidssalons en beautysalons.',
                'icon' => 'heroicon-o-sparkles',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        // Remove old categories that are no longer used
        Category::whereNotIn('slug', collect($categories)->pluck('slug'))->delete();

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
