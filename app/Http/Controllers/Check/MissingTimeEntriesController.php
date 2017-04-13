<?php declare(strict_types=1);

namespace App\Http\Controllers\Check;

use App\Events\MissingTimeEntry;
use App\Http\Controllers\Client;
use App\Repository\Mapper\UserMapper;
use App\Repository\TimesheetsRepository;
use App\Repository\UsersRepository;
use Illuminate\Support\Facades\Log;

/**
 * Class MissingTimeEntriesController
 * @package App\Http\Controllers\Check
 */
class MissingTimeEntriesController extends CheckBaseController
{
    const LOG_PREFIX = 'CHECK > MISSING TIME ENTRIES - ';

    /** @var Client $api */
    private $api;
    /** @var TimesheetsRepository $timesheets */
    public $timesheets;
    /** @var UsersRepository $user */
    private $user;
    /** @var int $failures */
    private $failures = 0;
    /** @var int count */
    private $count = 0;

    /**
     * MissingTimeEntriesController constructor.
     */
    public function __construct()
    {
        $this->api = new Client();
        $this->timesheets = new TimesheetsRepository();
        $this->user = new UsersRepository();
    }

    public function run()
    {
        $users = $this->getAllUserFromHarvest();

        if ($this->entriesExist($users)) {
            Log::notice(self::LOG_PREFIX . 'Users found, check every user now.');

            foreach ($users as $user) {
                $this->count++;

                $uid = $this->getUserIdFromHarvest($user);

                if ($uid !== null) {
                    LOG::notice(self::LOG_PREFIX . 'check entries of user: ' . $uid);

                    $entries = $this->getTimeEntriesFromHarvestByUserId($uid);

                    if ($this->entriesExist($entries) === false) {
                        $this->failures++;

                        LOG::notice(self::LOG_PREFIX . 'entries do not exist - fire event.');

                        $userMapper = new UserMapper();
                        $u = $userMapper->setUserData($user);

                        event(new MissingTimeEntry($u));
                    } else {
                        LOG::notice(self::LOG_PREFIX . 'entries exist - do nothing.');
                    }
                }
            }
        }

        if ($this->failures === 0) {
            $this->logNotice(self::LOG_PREFIX . 'great, found no missing time entries, nothing to do for now.');
        }

        return [
            'count' => $this->count,
            'failures' => $this->failures
        ];
    }

    private function getAllUserFromHarvest() : array
    {
        return $this->api->getResponse(
            $this->user->getAll()
        );
    }

    private function getUserIdFromHarvest($user) : int
    {
        $um = new UserMapper();
        $user = $um->setUserData($user);

        return (int) $user->getId();
    }

    private function getTimeEntriesFromHarvestByUserId($uid) : array
    {
        $day = $this->api->getResponse(
            $this->timesheets->getDailyOfUser($uid)
        );

        return $day['day_entries'];
    }
}
