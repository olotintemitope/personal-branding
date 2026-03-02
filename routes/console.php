<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('app:send-invoice-reminders')->dailyAt('09:00');
Schedule::command('app:send-task-reminders')->dailyAt('09:00');
Schedule::command('app:send-deadline-risk-alerts')->dailyAt('08:00');
Schedule::command('app:send-weekly-project-digest')->weeklyOn(1, '09:00');
Schedule::command('app:generate-weekly-retro')->weeklyOn(5, '17:00'); // Friday 5pm
