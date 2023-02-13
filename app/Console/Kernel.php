<?php

namespace App\Console;

use App\Models\StoreCommand;
use DateTimeZone;
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
        // $schedule->command('inspire')->hourly();
        $storeCommand = StoreCommand::find(1);
        if (!empty($storeCommand) && ($storeCommand->start != null)) {
            $time = date('H:i', strtotime($storeCommand->start));
            $newTime = (string) $time;
            $schedule->command('daily-quote')->dailyAt($newTime);
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
