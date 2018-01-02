<?php declare(strict_types=1);

namespace App\Console\Commands\Check;

use App\Events\MissingNote;
use BestIt\Harvest\Facade\Harvest;
use BestIt\Harvest\Models\Timesheet\DayEntry;
use BestIt\Harvest\Models\Users\User;
use Illuminate\Console\Command;

class MissingNotesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'b:check:missing_notes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for empty notes of todays daily time entries.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $users = Harvest::users()->all();

        info("Checking for missing notes, user count: {$users->count()}");
        $bar = $this->output->createProgressBar($users->count());

        /** @var User $user */
        foreach ($users as $user) {
            $faultyDayEntries = $this->getFaultyDayEntriesForUser($user);

            if (!empty($faultyDayEntries)) {
                foreach ($faultyDayEntries as $faultyDayEntry) {
                    info("{$user->email}'s day entry with the ID of {$faultyDayEntry->id} is faulty");
                    event(new MissingNote($user, $faultyDayEntry));
                }
            }

            $bar->advance();
        }

        $bar->finish();
    }

    /**
     * Retrieve all day entries of the given users that have any errors.
     * Only checking if notes are empty for the time being.
     *
     * @param User $user
     * @return DayEntry[]
     */
    private function getFaultyDayEntriesForUser(User $user): array
    {
        $faultyDayEntries = [];
        $timesheet = Harvest::timesheet()->all(true, null, $user->id);

        /** @var DayEntry $dayEntry */
        foreach ($timesheet->dayEntries as $dayEntry) {
            if (empty($dayEntry->notes)) {
                $faultyDayEntries[] = $dayEntry;
            }
        }

        return $faultyDayEntries;
    }
}
