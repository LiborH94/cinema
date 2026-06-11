<?php

namespace App\Console\Commands;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Play;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

#[Signature('app:refresh-daily-plays')]
#[Description('Command description')]
class RefreshDailyPlays extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        Play::where('start_date', '<', today())->delete();

        $halls = Hall::all();
        $movies = Movie::all();
        $date = Carbon::today()->addDays(8)->toDateString();
        $availableTimes = ['11:00', '13:00', '15:30', '18:00', '20:30'];
        $numberOfPlays = rand(4, count($availableTimes));
        $timesForToday = collect($availableTimes)->shuffle()->take($numberOfPlays);

        foreach ($timesForToday as $time) {
            Play::create([
                'movie_id' => $movies->random()->id,
                'hall_id' => $halls->random()->id,
                'start_date' => $date,
                'start_time' => $time,
                'standard_price' => $price = rand(130, 180),
                'vip_price' => $price + 50,
            ]);
        }

        $todayPlays = Play::with('hall.seats')
            ->where('start_date', today())
            ->get();
        $users = User::where('role', '!=', 'admin')->get();

        foreach ($todayPlays as $play) {
            $users->random(rand(1, 3))->each(function ($user) use ($play) {
                $seat = $play->hall->seats->random();
                Ticket::updateOrCreate(
                    ['play_id' => $play->id, 'seat_id' => $seat->id],
                    ['user_id' => $user->id, 'price_paid' => $play->standard_price]
                );
            });
        }

        $this->info('Denní refresh hotov.');
    }
}
