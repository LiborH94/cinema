<?php

namespace Database\Seeders;

use App\Models\Play;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $plays = Play::with('hall.seats')->get();

        if ($users->isEmpty() || $plays->isEmpty()) {
            $this->command->error('Nelze generovat lístky, chybí uživatelé nebo představení!');
            return;
        }

        foreach ($users as $user) {
            for ($i = 0; $i < 4; $i++) {

                $randomPlay = $plays->random();

                $randomSeat = $randomPlay->hall->seats->random();

                $price = $randomPlay->standard_price;

                Ticket::updateOrCreate(
                    [
                        'play_id' => $randomPlay->id,
                        'seat_id' => $randomSeat->id,
                    ],
                    [
                        'user_id' => $user->id,
                        'price_paid' => $price,
                    ]
                );
            }
        }

        $this->command->info('Lístky byly bezpečně vygenerovány bez duplicit!');
    }
}
