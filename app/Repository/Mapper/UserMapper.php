<?php
declare(strict_types=1);

namespace App\Repository\Mapper;

use App\Models\User;

class UserMapper
{
    public function setUserData($data)
    {
        $user = new User();

        $user->setId($data['user']['id']);
        $user->setEmail($data['user']['email']);
        $user->setCreatedAt($data['user']['created_at']);
        $user->setIsAdmin($data['user']['is_admin']);
        $user->setFirstName($data['user']['first_name']);
        $user->setLastName($data['user']['last_name']);
        $user->setTimezone($data['user']['timezone']);
        $user->setIsContractor($data['user']['is_contractor']);
        $user->setTelephone($data['user']['telephone']);
        $user->setIsActive($data['user']['is_active']);
        $user->setHasAccessToAllFutureProjects($data['user']['has_access_to_all_future_projects']);
        $user->setDefaultHourlyRate($data['user']['default_hourly_rate']);
        $user->setDepartment($data['user']['department']);
        $user->setWantsNewsletter($data['user']['wants_newsletter']);
        $user->setUpdatedAt($data['user']['updated_at']);
        $user->setCostRate($data['user']['cost_rate']);
        $user->setWeeklyCapacity($data['user']['weekly_capacity']);

        return $user;
    }
}
