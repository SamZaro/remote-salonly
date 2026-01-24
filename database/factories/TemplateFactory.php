<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Template>
 */
class TemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => fake()->words(2, true),
            'slug' => fake()->slug(),
            'description' => fake()->sentence(),
            'default_config' => [],
            'theme_config' => [
                'colors' => [
                    'primary' => '#3b82f6',
                    'secondary' => '#64748b',
                    'text' => '#333333',
                    'background' => '#ffffff',
                ],
            ],
            'navigation_items' => [],
            'sort_order' => 0,
            'is_active' => true,
        ];
    }
}
