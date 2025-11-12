<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sitemap:generate')->everyMinute();
        $schedule->command('sellers:unavailable')->daily();
        $schedule->command('expired:bids')->daily();
        $schedule->command('expired:projects')->daily();
        $schedule->command('app:upgrade-user-level')->twiceDaily(1, 13);
        
        // Hourly contract lifecycle commands
        // Generate weekly invoices every Monday at 00:30 UTC
        $schedule->command('hourly:generate-invoices')
            ->weeklyOn(1, '00:30')
            ->timezone('UTC');
        
        // Lock previous week's time entries every Monday at 12:00 UTC
        $schedule->command('hourly:lock-entries')
            ->weeklyOn(1, '12:00')
            ->timezone('UTC');
        
        // Release payments daily at 00:00 UTC
        $schedule->command('hourly:release-payments')
            ->dailyAt('00:00')
            ->timezone('UTC');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
