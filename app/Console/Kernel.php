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
        // Generate hourly invoices every Monday at 00:05
        $schedule->command('hourly:generate-weekly-invoices')->weeklyOn(1, '0:05');
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
