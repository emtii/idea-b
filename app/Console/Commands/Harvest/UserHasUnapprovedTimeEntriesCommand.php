<?php declare(strict_types=1);

namespace App\Console\Commands\Harvest;

use App\Events\Commands\Harvest\UserHasUnapprovedTimeEntriesEvent;
use BestIt\Harvest\Facade\Harvest;
use BestIt\Harvest\Models\Reports\DayEntry;
use BestIt\Harvest\Models\Users\User;
use DateTime;
use Illuminate\Console\Command;

class UserHasUnapprovedTimeEntriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'b:check:unapproved_timeentries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Harvest for unapproved timeentries of last week.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $users = Harvest::users()->all();

        info('Checking for unapproved time entries');

        if ($users !== null) {
            /** @var User $user */
            foreach ($users as $user) {
                $userHasUnapprovedTimeEntry = false;

                // check for unapproved time entries only for active users
                if ($user->isActive === true) {
                    $userHasUnapprovedTimeEntry = $this->doesThisUserHasUnapprovedTimeEntries($user);
                }

                if ($userHasUnapprovedTimeEntry) {
                    info("{$user->email} still has unapproved time entries in his last week");
                    event(new UserHasUnapprovedTimeEntriesEvent($user->email));

                    return;
                }

                info("{$user->email} is fine.");
            }
        }

        info('No users found.');
    }

    /**
     * Check if this given User has any unapproved time entries in the last week.
     * As this command runs every monday we can check for the last week.
     *
     * @param User $user
     *
     * @return bool
     */
    private function doesThisUserHasUnapprovedTimeEntries(User $user): bool
    {
        $from = new DateTime('Monday last week 00:00:01');
        $to = new DateTime('Friday last week 23:59:59');

        $timeentries = Harvest::users()->report(
            $user->id,
            $from,
            $to
        );

        if ($timeentries !== null) {
            /** @var DayEntry $timeentry */
            foreach ($timeentries as $timeentry) {
                if ($timeentry->isClosed === false) {
                    // this user still has unapproved time entries
                    return true;
                }
            }
        }

        return false;
    }
}
