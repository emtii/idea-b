<?php

namespace App\Console\Commands\Check;

use App\Events\BookedLessThan;
use BestIt\Harvest\Facade\Harvest;
use BestIt\Harvest\Models\Timesheet\DayEntry;
use BestIt\Harvest\Models\Users\User;
use Illuminate\Console\Command;

class BookedLessThanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'b:check:booked_less_than {--hours=4}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if users have logged less than x hours today.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $users = Harvest::users()->all();

        info(
            "Checking if users have logged less than {$this->option('hours')} of work | User count: {$users->count()}"
        );
        $bar = $this->output->createProgressBar($users->count());

        /** @var User $user */
        foreach ($users as $user) {
            if ($this->hasUserLoggedLessThanXHours($user)) {
                info("{$user->email} has logged less than {$this->option('hours')} hours today.");
                event(new BookedLessThan($user, $this->option('hours')));
            }

            $bar->advance();
        }

        $bar->finish();
    }

    /**
     * Check if the given user has logged less than x hours.
     *
     * @param User $user
     * @return bool
     */
    private function hasUserLoggedLessThanXHours(User $user): bool
    {
        $time = 0.00;
        $timesheet = Harvest::timesheet()->all(true, null, $user->id);

        /** @var DayEntry $dayEntry */
        foreach ($timesheet->dayEntries as $dayEntry) {
            $time += $dayEntry->hours;
        }

        return $time < $this->option('hours');
    }
}
