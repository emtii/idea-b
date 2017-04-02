<?php
declare(strict_types=1);

namespace App\Http\Controllers\Check;

use App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Repository\Mapper\TimesheetMapper;
use App\Repository\Mapper\UserMapper;
use App\Repository\TimesheetsRepository;
use App\Repository\UsersRepository;

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
     */
    public function run() : void
    {
        // get today's time entries
        $entries = $this->api->getResponse(
            $this->timesheets->getEntriesForCurrentDay()
        );

        foreach ($entries['day_entries'] as $entry) {
            // set timesheet data
            $day = $this->timesheetMapper->setTimesheetData($entry);

            // check for faulty notes
            if ($this->hasMissingNotes($day->getNotes())) {
                // get single user by his id
                $user = $this->user->getSingle(
                    $day->getUserId()
                );

                // set user data
                $user = $this->userMapper->setUserData($user);

                // send mail
                $this->sendMail($user->getEmail());
            }
        }
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

    private function sendMail($userMail) : bool
    {
        // TODO: Use Laravel Mailer Component here
    }
}
