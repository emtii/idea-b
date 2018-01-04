<?php declare(strict_types=1);

namespace App\Console\Commands\Harvest;

use App\Events\Commands\Harvest\UserHasCuriousTimeEntryEvent;
use BestIt\Harvest\Facade\Harvest;
use BestIt\Harvest\Models\Timesheet\DayEntry;
use BestIt\Harvest\Models\Users\User;
use Illuminate\Console\Command;

class UserHasCuriousTimeEntryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'b:check:curious_timeentries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check harvest for curious time entries e.g. > 8h in one entry.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $users = Harvest::users()->all();

        info('Checking for curious time entries.');

        if ($users !== null) {
            /** @var User $user */
            foreach ($users as $user) {
                // get faulty day entries only for active users
                if ($user->isActive === true) {
                    $curiousTimeEntries = $this->getCuriousTimeEntriesOfUser($user);

                    // if customer has curious day entries fire event
                    if ($curiousTimeEntries !== null) {
                        foreach ($curiousTimeEntries as $curiousTimeEntry) {
                            info("{$user->email} 's day entry is faulty.");

                            event(new UserHasCuriousTimeEntryEvent($curiousTimeEntry, $user));
                        }
                    }

                    if (!$curiousTimeEntries) {
                        info("{$user->email}'s day entries are fine.");
                    }
                }
            }
        }
    }

    /**
     * Retrieve all day entries of the given users to check for curiousities.
     *
     * @param User $user
     * @return array
     */
    private function getCuriousTimeEntriesOfUser(User $user): array
    {
        $curiousTimeEntries = [];
        $timesheet = Harvest::timesheet()->all(true, null, $user->id);

        if ($timesheet !== null) {
            /** @var DayEntry $dayEntry */
            foreach ($timesheet->dayEntries as $dayEntry) {
                if ($this->isThisEntryCurious($dayEntry)) {
                    $curiousTimeEntries[] = $dayEntry;
                }
            }
        }

        return $curiousTimeEntries;
    }

    /**
     * Check all rules for curiosities
     *
     * @param $dayEntry
     * @return bool
     */
    private function isThisEntryCurious($dayEntry): bool
    {
        // 8 hours and more in one timeentry is very like to be wrong
        if ($this->doesThisDayEntryHasMoreOrEqualEightHours($dayEntry)) {
            return true;
        }

        // @todo: add more checks

        return false;
    }

    /**
     * Does this time entry has more than eight hours booked onto?
     *
     * @param DayEntry $dayEntry
     * @return bool
     */
    private function doesThisDayEntryHasMoreOrEqualEightHours(DayEntry $dayEntry): bool
    {
        $bookedHours = (double) $dayEntry->hours;
        return $bookedHours >= 8;
    }
}
