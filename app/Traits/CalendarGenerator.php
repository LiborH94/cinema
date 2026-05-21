<?php

namespace App\Traits;

trait CalendarGenerator
{
    private function getCalendarDays($selectedDate)
    {
        $days = [];
        $startDate = now();

        for ($i = 0; $i < 14; $i++) {
            $date = $startDate->copy()->addDays($i);
            $formatted = $date->toDateString();

            $days[] = [
                'date' => $date,
                'formatted' => $formatted,
                'active' => $formatted === $selectedDate,
            ];
        }

        return $days;
    }
}
