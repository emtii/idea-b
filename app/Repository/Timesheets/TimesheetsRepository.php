<?php

namespace App\Repository\Timesheets;

use App\Repository\Repository;

/**
 * Class TimesheetsRepository
 * @package App\Repository\Timesheets
 */
class TimesheetsRepository implements Repository
{
    /**
     * @inheritdoc
     */
    public function getAll()
    {
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/daily/show/{DAY_ENTRY_ID}
     *
     * @param $id
     * @return string
     */
    public function getSingle($id)
    {
        return '/daily/' . $id;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/daily
     * GET https://YOURACCOUNT.harvestapp.com/daily?slim=1
     *
     * @param boolean $slim
     * @return string
     */
    public function getEntriesForCurrentDay($slim = false)
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
    public function getEntriesForASpecificDate()
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
    public function getEntriesOfUserById($uid)
    {
        return '/daily/?of_user' . $uid;
    }
}
