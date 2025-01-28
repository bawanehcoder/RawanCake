<?php

namespace App\Console;

use App\Console\Commands\CheckForOccasions;
use App\Console\Commands\SyncCategories;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        CheckForOccasions::class,
        SyncCategories::class];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('user:occasions')->dailyAt('02:00');
        $schedule->command('sync:categories-data')->dailyAt('02:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
