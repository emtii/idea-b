<?php
declare(strict_types=1);

namespace App\Repository\Mapper;

use App\Models\Timesheet;

class TimesheetMapper
{
    public function setTimesheetData(array $data)
    {
        $timesheet = new Timesheet();

        $timesheet->setId($data['id']);
        $timesheet->setUserId($data['user_id']);
        $timesheet->setSpentAt($data['spent_at']);
        $timesheet->setCreatedAt($data['created_at']);
        $timesheet->setUpdatedAt($data['updated_at']);
        $timesheet->setProjectId($data['project_id']);
        $timesheet->setTaskId($data['task_id']);
        $timesheet->setProject($data['project']);
        $timesheet->setTask($data['task']);
        $timesheet->setClient($data['client']);
        $timesheet->setNotes($data['notes']);
        $timesheet->setHoursWithoutTimer($data['hours_without_timer']);
        $timesheet->setHours($data['hours']);

        return $timesheet;
    }
}
