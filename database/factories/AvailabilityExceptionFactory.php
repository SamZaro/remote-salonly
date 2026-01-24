<?php

namespace Database\Factories;

use App\Models\AvailabilityException;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AvailabilityException>
 */
class AvailabilityExceptionFactory extends Factory
{
    protected $model = AvailabilityException::class;

    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'is_available' => false,
            'custom_open_time' => null,
            'custom_close_time' => null,
            'reason' => $this->faker->optional()->sentence(),
        ];
    }

    public function available(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_available' => true,
            'custom_open_time' => '10:00',
            'custom_close_time' => '16:00',
        ]);
    }

    public function holiday(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_available' => false,
            'reason' => 'Feestdag',
        ]);
    }
}
