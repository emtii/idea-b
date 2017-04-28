<?php declare(strict_types=1);

namespace App\Console\Commands\Check;

use App\Events\MissingTimeEntry;
use BestIt\Harvest\Facade\Harvest;
use BestIt\Harvest\Models\Users\User;
use Illuminate\Console\Command;

class MissingTimeEntriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'b:check:missing_timeentries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check every existing harvest user for missing time entries today.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $users = Harvest::users()->all();

        info("Checking for missing time entries, user count: {$users->count()}");
        $bar = $this->output->createProgressBar($users->count());

        /** @var User $user */
        foreach ($users as $user) {
            $timesheet = Harvest::timesheet()->all(true, null, $user->id);

            if ($timesheet->dayEntries->count() === 0) {
                info("{$user->email} does not have any time entries today.");
                event(new MissingTimeEntry($user));
            }

            $bar->advance();
        }

        $bar->finish();
    }
}
