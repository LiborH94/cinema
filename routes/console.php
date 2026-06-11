<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Schedule::command('clear-old-cart-items')->everyFiveMinutes();
Schedule::command('app:refresh-daily-plays')->dailyAt('03:00');
