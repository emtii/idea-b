<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Class Timesheet
 * @package App\Models
 */
class Timesheet
{
    /**
     * @var $id
     */
    private $id;
    /**
     * @var $user_id
     */
    private $user_id;
    /**
     * @var $spent_at
     */
    private $spent_at;
    /**
     * @var $created_at
     */
    private $created_at;
    /**
     * @var $updated_at
     */
    private $updated_at;
    /**
     * @var $project_id
     */
    private $project_id;
    /**
     * @var $task_id
     */
    private $task_id;
    /**
     * @var $project
     */
    private $project;
    /**
     * @var $task
     */
    private $task;
    /**
     * @var $client
     */
    private $client;
    /**
     * @var $notes
     */
    private $notes;
    /**
     * @var $hours_without_timer
     */
    private $hours_without_timer;
    /**
     * @var $hours
     */
    private $hours;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getSpentAt()
    {
        return $this->spent_at;
    }

    /**
     * @param mixed $spent_at
     */
    public function setSpentAt($spent_at)
    {
        $this->spent_at = $spent_at;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * @param mixed $project_id
     */
    public function setProjectId($project_id)
    {
        $this->project_id = $project_id;
    }

    /**
     * @return mixed
     */
    public function getTaskId()
    {
        return $this->task_id;
    }

    /**
     * @param mixed $task_id
     */
    public function setTaskId($task_id)
    {
        $this->task_id = $task_id;
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * @return mixed
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @param mixed $task
     */
    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getHoursWithoutTimer()
    {
        return $this->hours_without_timer;
    }

    /**
     * @param mixed $hours_without_timer
     */
    public function setHoursWithoutTimer($hours_without_timer)
    {
        $this->hours_without_timer = $hours_without_timer;
    }

    /**
     * @return mixed
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @param mixed $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }
}
