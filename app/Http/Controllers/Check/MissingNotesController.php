<?php
declare(strict_types=1);

namespace App\Http\Controllers\Check;

use App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Mail\Check\MissingNotesMail;
use App\Models\Timesheet;
use App\Repository\Mapper\TimesheetMapper;
use App\Repository\Mapper\UserMapper;
use App\Repository\TimesheetsRepository;
use App\Repository\UsersRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
    public $timesheets;
    /**
     * @var UsersRepository $user
     */
    private $user;
    /**
     * @var UserMapper $userMapper
     */
    private $userMapper;
    /**
     * @var TimesheetMapper $timesheetMapper
     */
    private $timesheetMapper;

    /**
     * MissingNotesController constructor.
     */
    public function __construct()
    {
        $this->api = new Client();
        $this->timesheets = new TimesheetsRepository();
        $this->user = new UsersRepository();
        $this->userMapper = new UserMapper();
        $this->timesheetMapper = new TimesheetMapper();
    }

    /**
     * Run this Check Up.
     *
     * @return boolean
     */
    public function run() : bool
    {
        Log::info('CHECK > MISSING NOTES - get todays time entries');
        // get today's time entries
        $entries = $this->api->getResponse(
            $this->timesheets->getEntriesForCurrentDay()
        );

        // failure count
        $failures = 0;

        if (is_array($entries) || !empty($entries)) {
            Log::info('CHECK > MISSING NOTES - found entries, iterate them now.');

            foreach ($entries['day_entries'] as $entry) {
                // set timesheet data
                $day = $this->timesheetMapper->setTimesheetData($entry);

                Log::info('CHECK > MISSING NOTES - check time entry id: ' . $day->getId());

                // check for faulty notes
                if ($this->hasMissingNotes($day->getNotes())) {
                    Log::warning('CHECK > MISSING NOTES - found faulty entry with id: ' . $day->getId());

                    $failures++;

                    // get single user by his id
                    $user = $this->api->getResponse(
                        $this->user->getSingle(
                            $day->getUserId()
                        )
                    );

                    // set user data
                    $user = $this->userMapper->setUserData($user);

                    Log::notice('CHECK > MISSING NOTES - last faulty entry was done by: ' . $user->getEmail());

                    // send mail
                    $this->sendMail($user->getEmail(), $day);
                }
            }
        }

        if ($failures <= 0) {
            Log::info('CHECK > MISSING NOTES - found no entries, nothing to do for now.');
        }


        return true;
    }

    /**
     * Check for missing notes.
     * @param $notes
     * @return bool
     */
    private function hasMissingNotes($notes) : bool
    {
        trim($notes);

        return $notes === '' || $notes === null;
    }

    /**
     * Send eMail to Customer about his faulty note in his timesheet.
     * @param string $userMail
     * @param Timesheet $day
     * @return bool
     */
    private function sendMail(string $userMail, Timesheet $day) : bool
    {
        Log::notice('CHECK > MISSING NOTES - start send mail to ' . $userMail);

        Mail::to($userMail)
            ->send(new MissingNotesMail($day));

        Log::notice('CHECK > MISSING NOTES - end send mail to ' . $userMail);

        return true;
    }
}
