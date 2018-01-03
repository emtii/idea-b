<?php declare(strict_types=1);

namespace App\Console\Commands\Harvest;

use App\Events\Commands\Harvest\UserHasMissingNoteEvent;
use BestIt\Harvest\Facade\Harvest;
use BestIt\Harvest\Models\Timesheet\DayEntry;
use BestIt\Harvest\Models\Users\User;
use Illuminate\Console\Command;

class UserHasMissingNotesCommand extends Command
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
    protected $description = 'Harvest for empty notes of todays daily time entries.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $users = Harvest::users()->all();

        info('Checking for missing notes.');

        /** @var User $user */
        foreach ($users as $user) {
            $faultyDayEntries = null;

            // get faulty day entries only for active users
            if ($user->isActive === true) {
                $faultyDayEntries = $this->getFaultyDayEntriesForUser($user);
            }

            // if customer has faulty day entries fire event
            if ($faultyDayEntries !== null) {
                foreach ($faultyDayEntries as $faultyDayEntry) {
                    info("{$user->email}'s day entry with the ID of {$faultyDayEntry->id} is faulty");
                    event(new UserHasMissingNoteEvent($user, $faultyDayEntry));
                }
            }

            info("{$user->email}'s day entries are fine.");
        }
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
