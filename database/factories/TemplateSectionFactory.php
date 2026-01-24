<?php

namespace Database\Factories;

use App\Models\Template;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TemplateSection>
 */
class TemplateSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'template_id' => Template::factory(),
            'section_type' => fake()->randomElement(['hero', 'about', 'services', 'pricing', 'contact', 'content']),
            'order' => fake()->numberBetween(1, 10),
            'content' => [
                'title' => fake()->sentence(),
                'description' => fake()->paragraph(),
            ],
            'is_active' => true,
        ];
    }
}
