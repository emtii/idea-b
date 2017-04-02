<?php
declare(strict_types=1);

namespace App\Repository\Mapper;

use App\Models\User;

class UserMapper
{
    public function setUserData(array $data)
    {
        $user = new User();

        $user->setId($data['id']);
        $user->setEmail($data['email']);
        $user->setCreatedAt($data['created_at']);
        $user->setIsAdmin($data['is_admin']);
        $user->setFirstName($data['first_name']);
        $user->setLastName($data['last_name']);
        $user->setTimezone($data['timezone']);
        $user->setIsContractor($data['is_contractor']);
        $user->setTelephone($data['telephone']);
        $user->setIsActive($data['is_active']);
        $user->setHasAccessToAllFutureProjects($data['has_access_to_all_future_projects']);
        $user->setDefaultHourlyRate($data['default_hourly_rate']);
        $user->setDepartment($data['department']);
        $user->setWantsNewsletter($data['wants_newsletter']);
        $user->setUpdatedAt($data['updated_at']);
        $user->setCostRate($data['cost_rate']);
        $user->setWeeklyCapacity($data['weekly_capacity']);

        return $user;
    }
}
