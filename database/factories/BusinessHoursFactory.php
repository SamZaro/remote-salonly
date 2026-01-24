<?php

namespace Database\Factories;

use App\Models\BusinessHours;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BusinessHours>
 */
class BusinessHoursFactory extends Factory
{
    protected $model = BusinessHours::class;

    public function definition(): array
    {
        return [
            'day_of_week' => $this->faker->unique()->numberBetween(0, 6),
            'open_time' => '09:00',
            'close_time' => '17:00',
            'is_open' => true,
            'slot_duration' => 30,
        ];
    }

    public function closed(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_open' => false,
        ]);
    }

    public function forDay(int $dayOfWeek): static
    {
        return $this->state(fn (array $attributes) => [
            'day_of_week' => $dayOfWeek,
        ]);
    }
}
