<?php

namespace Database\Factories;

use App\Models\Hall;
use App\Models\Seat;
use App\SeatType;
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
            'rows_count' => $this->faker->numberBetween(5, 12),
            'columns_count' => $this->faker->numberBetween(8, 16),
        ];
    }
    public function configure(): static
    {
        return $this->afterCreating(function (Hall $hall) {
            $seats = [];
            $now = now();

            for ($i = 1; $i <= $hall->rows_count; $i++) {
                for ($j = 1; $j <= $hall->columns_count; $j++) {
                    $seats[] = [
                        'hall_id' => $hall->id,
                        'row' => $i,
                        'column' => $j,
                        'type' => $this->faker->randomElement([
                            SeatType::STANDARD->value,
                            SeatType::VIP->value,
                            SeatType::DISABLED->value
                        ]),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }
            Seat::insert($seats);
        });
    }
}
