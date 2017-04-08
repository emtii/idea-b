<?php
declare(strict_types=1);

namespace App\Repository;

/**
 * Class TimesheetsRepository
 * @package App\Repository
 */
class TimesheetsRepository implements RepositoryInterface
{
    /**
     * GET https://YOURACCOUNT.harvestapp.com/daily
     *
     * @return string
     */
    public function getAll() : string
    {
        return '/daily';
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/daily/show/{DAY_ENTRY_ID}
     *
     * @param $id
     * @return string
     */
    public function getSingle($id) : string
    {
        return '/daily/show/' . $id;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/daily
     * GET https://YOURACCOUNT.harvestapp.com/daily?slim=1
     *
     * @param boolean $slim
     * @return string
     */
    public function getEntriesForCurrentDay($slim = false) : string
    {
        if ($slim) {
            return '/daily';
        } else {
            return '/daily?slim=1';
        }
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/daily/{DAY_OF_THE_YEAR}/{YEAR}
     *
     * @return string
     */
    public function getEntriesForASpecificDate() : string
    {
        $today = date('z') + 1;
        $year = date('Y');

        return '/daily/' . $today . '/' . $year;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/daily?of_user={OTHER_USER_ID}
     *
     * @param $uid
     * @return string
     */
    public function getDailyOfUser($uid) : string
    {
        return '/daily/?of_user=' . $uid;
    }
}
