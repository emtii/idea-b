<?php

namespace App\Console;

use App\Console\Commands\Harvest\UserHasCuriousTimeEntryCommand;
use App\Console\Commands\Harvest\UserHasMissingNotesCommand;
use App\Console\Commands\Harvest\UserHasUnapprovedTimeEntriesCommand;
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
        UserHasMissingNotesCommand::class,
        UserHasUnapprovedTimeEntriesCommand::class,
        UserHasCuriousTimeEntryCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(UserHasMissingNotesCommand::class)
            ->everyThirtyMinutes()
            ->between('07:00', '18:00');

        $schedule->command(UserHasUnapprovedTimeEntriesCommand::class)
            ->weekly()
            ->mondays()
            ->at('10:00');

        $schedule->command(UserHasCuriousTimeEntryCommand::class)
            ->hourly()
            ->between('07:00', '18:00');
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
