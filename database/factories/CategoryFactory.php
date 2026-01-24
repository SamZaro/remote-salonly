<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'slug' => fake()->slug(),
            'description' => fake()->sentence(),
            'icon' => fake()->randomElement(['heroicon-o-briefcase', 'heroicon-o-home', 'heroicon-o-shopping-bag']),
            'sort_order' => 0,
            'is_active' => true,
        ];
    }
}
