<?php

namespace App\Console;

use App\Jobs\ProcessVaccinatedCandidatesJob;
use App\Jobs\ScheduleUnvaccinatedCandidatesJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
       
        $schedule->job(new ScheduleUnvaccinatedCandidatesJob)
                     ->timezone('Asia/Dhaka')
                     ->dailyAt('21:00')
                     ->days([0, 1, 2, 3, 6]);

        $schedule->job(new ProcessVaccinatedCandidatesJob)
                     ->timezone('Asia/Dhaka')
                     ->dailyAt('21:00');
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
