<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Play;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PlaySeeder extends Seeder
{
    public function run(): void
    {
        $halls = Hall::all();
        $movies = Movie::all();

        if ($halls->isEmpty() || $movies->isEmpty()) {
            $this->command->error('Nelze generovat program, chybí sály nebo filmy!');
            return;
        }

        $availableTimes = ['11:00', '13:00', '15:30', '18:00', '20:30'];

        for ($day = 0; $day <= 8; $day++) {
            $date = Carbon::today()->addDays($day)->toDateString();
            $numberOfPlays = rand(4, count($availableTimes));
            $timesForToday = collect($availableTimes)->shuffle()->take($numberOfPlays);

            foreach ($timesForToday as $time) {
                $randomMovie = $movies->random();
                $randomHall = $halls->random();

                $standardPrice = rand(130, 180);
                $vipPrice = $standardPrice + 50;

                Play::create([
                    'movie_id' => $randomMovie->id,
                    'hall_id' => $randomHall->id,

                    'start_date' => $date,
                    'start_time' => $time,
                    'standard_price' => $standardPrice,
                    'vip_price' => $vipPrice,
                ]);
            }
        }

        $this->command->info('Náhodný program pro různé sály byl úspěšně vygenerován.');
    }
}
