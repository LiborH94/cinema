<?php

namespace Database\Factories;

use App\Models\Hall;
use App\Models\Seat;
use App\SeatType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hall_id' => Hall::factory(),
            'row' => 1,
            'column' => 1,
            'type' => $this->faker->randomElement([
                SeatType::STANDARD->value,
                SeatType::VIP->value,
                SeatType::DISABLED->value
            ]),
        ];
    }
}
