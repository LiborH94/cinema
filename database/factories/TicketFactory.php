<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\SeatType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = UserFactory::create();
        $play = PlayFactory::create();
        $seat = $play->hall->seats()->inRandomOrder()->first();

        $pricePaid = $seat->type === SeatType::VIP->value ? $play-vip_price : $play->standard_price;

        return [
            'user_id' => $user->id,
            'play_id' => $play->id,
            'seat_id' => $seat->id,
            'price_paid' => $pricePaid,
        ];
    }
}
