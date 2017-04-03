<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Class User
 * @package App\Models
 */
class User
{
    /**
     * @var $id
     */
    private $id;
    /**
     * @var $email
     */
    private $email;
    /**
     * @var $created_at
     */
    private $created_at;
    /**
     * @var $is_admin
     */
    private $is_admin;
    /**
     * @var $first_name
     */
    private $first_name;
    /**
     * @var $last_name
     */
    private $last_name;
    /**
     * @var $timezone
     */
    private $timezone;
    /**
     * @var $is_contractor
     */
    private $is_contractor;
    /**
     * @var $telephone
     */
    private $telephone;
    /**
     * @var $is_active
     */
    private $is_active;
    /**
     * @var $has_access_to_all_future_projects
     */
    private $has_access_to_all_future_projects;
    /**
     * @var $default_hourly_rate
     */
    private $default_hourly_rate;
    /**
     * @var $department
     */
    private $department;
    /**
     * @var $wants_newsletter
     */
    private $wants_newsletter;
    /**
     * @var $updated_at
     */
    private $updated_at;
    /**
     * @var $cost_rate
     */
    private $cost_rate;
    /**
     * @var $weekly_capacity
     */
    private $weekly_capacity;

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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    /**
     * @param mixed $is_admin
     */
    public function setIsAdmin($is_admin)
    {
        $this->is_admin = $is_admin;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param mixed $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @return mixed
     */
    public function getIsContractor()
    {
        return $this->is_contractor;
    }

    /**
     * @param mixed $is_contractor
     */
    public function setIsContractor($is_contractor)
    {
        $this->is_contractor = $is_contractor;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * @param mixed $is_active
     */
    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;
    }

    /**
     * @return mixed
     */
    public function getHasAccessToAllFutureProjects()
    {
        return $this->has_access_to_all_future_projects;
    }

    /**
     * @param mixed $has_access_to_all_future_projects
     */
    public function setHasAccessToAllFutureProjects($has_access_to_all_future_projects)
    {
        $this->has_access_to_all_future_projects = $has_access_to_all_future_projects;
    }

    /**
     * @return mixed
     */
    public function getDefaultHourlyRate()
    {
        return $this->default_hourly_rate;
    }

    /**
     * @param mixed $default_hourly_rate
     */
    public function setDefaultHourlyRate($default_hourly_rate)
    {
        $this->default_hourly_rate = $default_hourly_rate;
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param mixed $department
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    }

    /**
     * @return mixed
     */
    public function getWantsNewsletter()
    {
        return $this->wants_newsletter;
    }

    /**
     * @param mixed $wants_newsletter
     */
    public function setWantsNewsletter($wants_newsletter)
    {
        $this->wants_newsletter = $wants_newsletter;
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
    public function getCostRate()
    {
        return $this->cost_rate;
    }

    /**
     * @param mixed $cost_rate
     */
    public function setCostRate($cost_rate)
    {
        $this->cost_rate = $cost_rate;
    }

    /**
     * @return mixed
     */
    public function getWeeklyCapacity()
    {
        return $this->weekly_capacity;
    }

    /**
     * @param mixed $weekly_capacity
     */
    public function setWeeklyCapacity($weekly_capacity)
    {
        $this->weekly_capacity = $weekly_capacity;
    }
}
