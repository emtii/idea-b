<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\Timesheets;
use App\Http\Controllers\Api\Users;
use App\Mail\MissingNotes;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckMissingNotesCommand extends Command
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
     * @return mixed
     */
    public function handle()
    {
        $ts = new Timesheets();

        $entries = $ts->getEntriesOfCurrentDay();

        foreach ($entries['day_entries'] as $entry) {
            if ($this->hasMissingNotes($entry['notes']) === true) {
                // get user who did something wrong
                $user = new Users();
                $usermail = $user->getUserEmailById($entry['user_id']);

                // send mail to user
                Mail::to($usermail)
                    ->send(new MissingNotes($entry));
            }
        }

        return null;
    }

    private function hasMissingNotes($notes)
    {
        trim($notes);

        return $notes === '' || $notes === null;
    }
}
