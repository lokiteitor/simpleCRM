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
        // Commands\Inspire::class,
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
        // $schedule->command('inspire')
        //          ->hourly();


        $schedule->command('emails:evento')->daily()->sendOutputTo('logs/cron.log')->emailOutputTo('lokiteitor513@gmail.com');

        $schedule->command('emails:oportunidad')->daily()->sendOutputTo('logs/cron.log')->emailOutputTo('lokiteitor513@gmail.com');

        $schedule->command('emails:tareas')->daily()->sendOutputTo('logs/cron.log')->emailOutputTo('lokiteitor513@gmail.com');
        
        $schedule->command('clear')->daily()->sendOutputTo('logs/cron.log')->emailOutputTo('lokiteitor513@gmail.com');


    }
}
