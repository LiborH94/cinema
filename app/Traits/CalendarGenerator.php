<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait CalendarGenerator
{
    public function getCalendarDays(string $selectedDate, int $count = 10): Collection
    {
        return collect(range(0, $count))->map(function ($day) use ($selectedDate) {
            $date = now()->addDays($day);
            $formatted = $date->toDateString();
            return [
                'date' => $date,
                'formatted' => $formatted,
                'active' => $selectedDate === $formatted,
            ];
        });
    }
}
