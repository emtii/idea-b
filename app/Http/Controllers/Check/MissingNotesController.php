<?php declare(strict_types = 1);

namespace App\Http\Controllers\Check;

use App\Events\MissingNote;
use App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Repository\Mapper\TimesheetMapper;
use App\Repository\Mapper\UserMapper;
use App\Repository\TimesheetsRepository;
use App\Repository\UsersRepository;
use Illuminate\Support\Facades\Log;

/**
 * Class MissingNotesController
 * @package App\Http\Controllers\Check
 */
class MissingNotesController extends Controller
{
    const LOG_PREFIX = 'CHECK > MISSING NOTES - ';

    /**
     * @var TimesheetsRepository $timesheets
     */
    public $timesheets;
    /**
     * @var Client $api
     */
    private $api;
    /**
     * @var UsersRepository $user
     */
    private $user;

    /**
     * @var $failures
     */
    private $failures = 0;

    /**
     * @var $count
     */
    private $count = 0;

    /**
     * MissingNotesController constructor.
     */
    public function __construct()
    {
        $this->api = new Client();
        $this->timesheets = new TimesheetsRepository();
        $this->user = new UsersRepository();
    }

    /**
     * Run this Check Up.
     *
     * @return array
     */
    public function run() : array
    {
        $this->logNotice('get entries for today.');

        $entries = $this->getDaily();

        if ($this->entriesExist($entries)) {
            $this->logNotice('found time entries for today.');

            foreach ($entries as $entry) {
                // count checked entries
                $this->count++;

                // create timesheet out of entry
                $timesheetMapper = new TimesheetMapper();
                $ts = $timesheetMapper->setTimesheetData($entry);
                $this->logNotice('check entry id: ' . $ts->getId());

                // check if entry has missing notes
                if ($this->hasMissingNotes($ts->getNotes())) {
                    $this->logNotice('note faulty');

                    $this->failures++;

                    // create user
                    $user = $this->getUserById($ts->getUserId());
                    $userMapper = new UserMapper();
                    $u = $userMapper->setUserData($user);

                    /* Dispatch event, let listeners handle the heavy lifting. */
                    event(new MissingNote($u, $ts));
                } else {
                    $this->logNotice('note given.');
                }
            }
        }

        if ($this->failures === 0) {
            $this->logNotice('great, found no faulty entries, nothing to do for now.');
        }

        return [
            'count' => $this->count,
            'failures' => $this->failures
        ];
    }

    /**
     * Helper for logging.
     * @param $notice
     */
    private function logNotice($notice)
    {
        Log::notice(self::LOG_PREFIX . $notice);
    }

    /**
     * Get all time entries of today from api.
     * @return array
     */
    private function getDaily() : array
    {
        $day = $this->api->getResponse(
            $this->timesheets->getAll()
        );

        return $day['day_entries'];
    }

    /**
     * Check for existing entries.
     * @param array $entries
     * @return bool
     */
    private function entriesExist(array $entries) : bool
    {
        return is_array($entries) && !empty($entries);
    }

    /**
     * Check for missing notes.
     * @param $notes
     * @return bool
     */
    private function hasMissingNotes($notes) : bool
    {
        $notes = trim($notes);

        return $notes === '' || $notes === null;
    }

    /**
     * Get user data by id from api.
     * @param $uid
     * @return array
     */
    private function getUserById($uid)
    {
        $user = $this->api->getResponse(
            $this->user->getSingle($uid)
        );

        return $user;
    }
}
