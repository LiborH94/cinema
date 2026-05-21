<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\Seat;
use App\SeatType;
use Illuminate\Database\Seeder;

class HallSeeder extends Seeder
{
    public function run(): void
    {
        for($i = 1; $i < 8; $i++) {
            Hall::factory()->create([
                'name' => 'Sál '.$i,
            ]);
        }

    }
}
