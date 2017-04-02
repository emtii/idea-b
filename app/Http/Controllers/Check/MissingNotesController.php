<?php

namespace App\Http\Controllers\Check;

use App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Repository\Timesheets\TimesheetsRepository;

/**
 * Class MissingNotesController
 * @package App\Http\Controllers\Check
 */
class MissingNotesController extends Controller
{
    /**
     * @var Client $api
     */
    private $api;
    /**
     * @var TimesheetsRepository $timesheets
     */
    private $timesheets;

    /**
     * MissingNotesController constructor.
     */
    public function __construct()
    {
        $this->api = new Client();
        $this->timesheets = new TimesheetsRepository();
    }

    public function run()
    {
        $entries = $this->api->getResponse(
            $this->timesheets->getEntriesForCurrentDay()
        );

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
    }

    private function hasMissingNotes($notes)
    {
        trim($notes);

        return $notes === '' || $notes === null;
    }
}
