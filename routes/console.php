<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

if (env('DEMO_RESET_ENABLED', false)) {
    Schedule::command('demo:restore-database --force')
        ->everyFifteenMinutes()
        ->withoutOverlapping()
        ->onOneServer();
}
