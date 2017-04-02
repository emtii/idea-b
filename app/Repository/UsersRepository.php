<?php
declare(strict_types=1);

namespace App\Repository;

/**
 * Class UsersRepository
 * @package App\Repository
 */
class UsersRepository implements Repository
{
    /**
     * https://YOURACCOUNT.harvestapp.com/people
     *
     * @return string
     */
    public function getAll() : string
    {
        return '/people';
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/people/{USERID}
     *
     * @param $id
     * @return string
     */
    public function getSingle($id) : string
    {
        return '/people/' . $id;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/people?updated_since=2015-04-25+18%3A30
     *
     * @param $timestamp
     * @return string
     */
    public function getUserUpdatedSince($timestamp) : string
    {
        $date = date('Y-m-d', $timestamp);
        $time = date('H:i', $timestamp);

        return '/people?updated_since=' . $date . '+' . $time;
    }
}
