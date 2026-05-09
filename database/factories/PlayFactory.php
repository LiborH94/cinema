<?php

namespace Database\Factories;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Play;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Play>
 */
class PlayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_id' => Movie::factory(),
            'hall_id' => Hall::factory(),

            'date' => $this->faker->date(),
            'time' => $this->faker->time('H:i'),
            'price' => $this->faker->numberBetween(150, 200),
            'vip_price' => $this->faker->numberBetween(200, 300),
        ];
    }
}
