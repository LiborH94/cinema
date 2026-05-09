<?php

namespace Database\Factories;

use App\Models\Hall;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Hall>
 */
class HallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'rows_count' => $this->faker->numberBetween(1, 20),
            'columns_count' => $this->faker->numberBetween(1, 20),
        ];
    }
}
