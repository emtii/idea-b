<?php

namespace App\Repository\TimeReporting;

use App\Repository\Repository;

/**
 * Class TimeReporting
 * @package App\Repository\TimeReporting
 */
class TimeReportingRepository implements Repository
{
    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects
     *
     * @return string
     */
    public function getAll()
    {
        return '/projects';
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECTID}
     *
     * @param $id
     * @return string
     */
    public function getSingle($id)
    {
        return '/projects/' . $id;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECT_ID}/entries?from=YYYYMMDD&to=YYYYMMDD
     *
     * @param $pid
     * @param $from
     * @param $to
     * @return string
     */
    public function getAllEntriesForProjectTimeframe($pid, $from, $to)
    {
        $from = date('Y-m-d', $from);
        $to = date('Y-m-d', $to);

        return '/projects/' . $pid .'/entries?from=' . $from . '&to=' . $to;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/people/{USER_ID}/entries?from=YYYYMMDD&to=YYYYMMDD
     *
     * @param $uid
     * @param $from
     * @param $to
     * @return string
     */
    public function getAllEntriesByUserIdForTimeframe($uid, $from, $to)
    {
        $from = date('Y-m-d', $from);
        $to = date('Y-m-d', $to);

        return '/people/' . $uid .'/entries?from=' . $from . '&to=' . $to;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECT_ID}/entries?user_id=1334
     *
     * @param $pid
     * @param $uid
     * @return string
     */
    public function getAllEntriesByProjectIdAndUserId($pid, $uid)
    {
        return '/projects/' . $pid . '/entries?user_id=' . $uid;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECT_ID}/entries?from=YYYYMMDD&to=YYYYMMDD&updated_since=2010-09-25+18%3A30
     *
     * @param $pid
     * @param $from
     * @param $to
     * @param $timestamp
     * @return string
     */
    public function getAllEntriesForProjectTimeframeUpdatedSinceByProjectId(
        $pid,
        $from,
        $to,
        $timestamp
    ) {
        $from = date('Y-m-d', $from);
        $to = date('Y-m-d', $to);

        $date = date('Y-m-d', $timestamp);
        $time = date('H:i', $timestamp);

        return '/projects/' . $pid .'/entries?from=' . $from . '&to=' . $to . '?updated_since=' . $date . '+' . $time;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECT_ID}/entries?from=YYYYMMDD&to=YYYYMMDD&billable=yes
     *
     * @param $pid
     * @param $from
     * @param $to
     * @param string $billable
     * @return string
     */
    public function getAllEntriesByProjectIdForTimeFrameBillable(
        $pid,
        $from,
        $to,
        $billable = 'yes'
    ) {
        $from = date('Y-m-d', $from);
        $to = date('Y-m-d', $to);

        return '/projects/' . $pid .'/entries?from=' . $from . '&to=' . $to . '&billable=' . $billable;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECT_ID}/entries?from=YYYYMMDD&to=YYYYMMDD&only_billed=yes
     *
     * @param $pid
     * @param $from
     * @param $to
     * @param string $onlybilled
     * @return string
     */
    public function getAllEntriesByProjectIdForTimeFrameOnlyBilled(
        $pid,
        $from,
        $to,
        $onlybilled = 'yes'
    ) {
        $from = date('Y-m-d', $from);
        $to = date('Y-m-d', $to);

        return '/projects/' . $pid .'/entries?from=' . $from . '&to=' . $to . '&only_billed=' . $onlybilled;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECT_ID}/entries?from=YYYYMMDD&to=YYYYMMDD&only_unbilled=yes
     *
     * @param $pid
     * @param $from
     * @param $to
     * @param string $onlyunbilled
     * @return string
     */
    public function getAllEntriesByProjectIdForTimeFrameOnlyUnBilled(
        $pid,
        $from,
        $to,
        $onlyunbilled = 'yes'
    ) {
        $from = date('Y-m-d', $from);
        $to = date('Y-m-d', $to);

        return '/projects/' . $pid .'/entries?from=' . $from . '&to=' . $to . '&only_unbilled=' . $onlyunbilled;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECT_ID}/entries?from=YYYYMMDD&to=YYYYMMDD&is_closed=no
     *
     * @param $pid
     * @param $from
     * @param $to
     * @param string $isclosed
     * @return string
     */
    public function getAllClosedEntriesByProjectIdForTimeFrame(
        $pid,
        $from,
        $to,
        $isclosed = 'yes'
    ) {
        $from = date('Y-m-d', $from);
        $to = date('Y-m-d', $to);

        return '/projects/' . $pid .'/entries?from=' . $from . '&to=' . $to . '&is_closed=' . $isclosed;
    }
}
