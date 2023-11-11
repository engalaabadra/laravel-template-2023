<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\ExternalApiJob;
use Modules\Reservation\Entities\Reservation;

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
        $schedule->command('app:run-jobs');
        // $schedule->command('inspire')->hourly();
        // Example: Checking for reservations half an hour away
        // $schedule->call(function () {
        //     $reservations = Reservation::where('date',now()->format('Y-m-d'))
        //         ->where('start_time', '<=', now()->addMinutes(5))
        //         ->where('start_time', '>', now())
                
        //         ->get();

        //     foreach ($reservations as $reservation) {
        //         // Send reminder logic here
        //         $doctor = $reservation->doctor;
        //         $email = $doctor->email;
        //         $subject = 'Reservation Reminder';
        //         $message = 'Your reservation will start in less than 30 minutes.';
            
        //         dispatch(new ExternalApiJob($email, $message,'reminder-reservation'));
        //     }
        // })->everyMinute();

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
