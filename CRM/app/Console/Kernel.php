<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //Commands\Inspire::class,
        Commands\SendEmailOportunidad::class,
        Commands\SendEmailTarea::class,
        Commands\SendEmailEvento::class,
        Commands\SendEmails::class,
        Commands\Clear::class,
        Commands\Repetir::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('inspire')->hourly();



        $schedule->command('emails:evento')->everyFiveMinutes();

        $schedule->command('emails:oportunidad')->daily();

        $schedule->command('emails:tareas')->everyFiveMinutes();
        
        $schedule->command('clear')->daily();

        $schedule->command('repeat')->daily();

        $schedule->command('emails:send')->daily();

    }
}
