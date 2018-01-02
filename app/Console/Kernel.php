<?php

namespace App\Console;

use App\Console\Commands\Check\BookedLessThanCommand;
use App\Console\Commands\Check\MissingNotesCommand;
use App\Console\Commands\Check\MissingTimeEntriesCommand;
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
        MissingNotesCommand::class,
        MissingTimeEntriesCommand::class,
        BookedLessThanCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(MissingNotesCommand::class)->dailyAt('21:00');
        //$schedule->command(MissingTimeEntriesCommand::class)->dailyAt('22:00');
        //$schedule->command(BookedLessThanCommand::class)->dailyAt('20:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
