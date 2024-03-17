<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Task;

class TaskPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(Employee $user): bool
    {
        return $user->isAdmin() || $user->isManager();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Employee $user, Task $task): bool
    {
        return $user->isAdmin() ||
            ($user->isEmployee() && $user['id'] == $task['employee_id']);
    }
}
