<?php
declare(strict_types=1);

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
    public function getAll() : string
    {
        return '/projects';
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECTID}
     *
     * @param $id
     * @return string
     */
    public function getSingle($id) : string
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
    public function getAllEntriesForProjectTimeframe($pid, $from, $to) : string
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
    public function getAllEntriesByUserIdForTimeframe($uid, $from, $to) : string
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
    public function getAllEntriesByProjectIdAndUserId($pid, $uid) : string
    {
        return '/projects/' . $pid . '/entries?user_id=' . $uid;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECT_ID}/entries?from=YYYYMMDD&to=YYYYMMDD&updated_since=2010-09-25+18%3A30
     *
     * @param int $pid
     * @param array $timeframe
     * @param $timestamp
     * @return string
     */
    public function getAllEntriesForProjectTimeframeUpdatedSinceByProjectId(
        $timestamp,
        $pid = 0,
        array $timeframe = [
            'from' => 0,
            'to' => 0
        ]
    ) : string {
        $from = date('Y-m-d', $timeframe['from']);
        $to = date('Y-m-d', $timeframe['to']);

        $date = date('Y-m-d', $timestamp);
        $time = date('H:i', $timestamp);

        return '/projects/' . $pid .'/entries?from=' . $from . '&to=' . $to . '?updated_since=' . $date . '+' . $time;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECT_ID}/entries?from=YYYYMMDD&to=YYYYMMDD&billable=yes
     *
     * @param int $pid
     * @param array $timeframe
     * @param string $billable
     * @return string
     */
    public function getAllEntriesByProjectIdForTimeFrameBillable(
        $billable = 'yes',
        $pid = 0,
        array $timeframe = [
            'from' => 0,
            'to' => 0
        ]
    ) : string {
        $from = date('Y-m-d', $timeframe['from']);
        $to = date('Y-m-d', $timeframe['to']);

        return '/projects/' . $pid .'/entries?from=' . $from . '&to=' . $to . '&billable=' . $billable;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECT_ID}/entries?from=YYYYMMDD&to=YYYYMMDD&only_billed=yes
     *
     * @param string $onlybilled
     * @param int $pid
     * @param array $timeframe
     * @return string
     */
    public function getAllEntriesByProjectIdForTimeFrameOnlyBilled(
        $onlybilled = 'yes',
        $pid = 0,
        array $timeframe = [
            'from' => 0,
            'to' => 0
        ]
    ) : string {
        $from = date('Y-m-d', $timeframe['from']);
        $to = date('Y-m-d', $timeframe['to']);

        return '/projects/' . $pid .'/entries?from=' . $from . '&to=' . $to . '&only_billed=' . $onlybilled;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECT_ID}/entries?from=YYYYMMDD&to=YYYYMMDD&only_unbilled=yes
     *
     * @param string $onlyunbilled
     * @param int $pid
     * @param array $timeframe
     * @return string
     */
    public function getAllEntriesByProjectIdForTimeFrameOnlyUnBilled(
        $onlyunbilled = 'yes',
        $pid = 0,
        array $timeframe = [
            'from' => 0,
            'to' => 0
        ]
    ) : string {
        $from = date('Y-m-d', $timeframe['from']);
        $to = date('Y-m-d', $timeframe['to']);

        return '/projects/' . $pid .'/entries?from=' . $from . '&to=' . $to . '&only_unbilled=' . $onlyunbilled;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECT_ID}/entries?from=YYYYMMDD&to=YYYYMMDD&is_closed=yes
     *
     * @param string $isclosed
     * @param int $pid
     * @param array $timeframe
     * @return string
     */
    public function getAllClosedEntriesByProjectIdForTimeFrame(
        $isclosed = 'yes',
        $pid = 0,
        array $timeframe = [
            'from' => 0,
            'to' => 0
        ]
    ) : string {
        $from = date('Y-m-d', $timeframe['from']);
        $to = date('Y-m-d', $timeframe['to']);

        return '/projects/' . $pid .'/entries?from=' . $from . '&to=' . $to . '&is_closed=' . $isclosed;
    }
}
