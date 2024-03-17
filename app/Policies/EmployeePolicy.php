<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\Response;

class EmployeePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Employee $user): bool
    {
        return $user->isAdmin() || $user->isManager();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Employee $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Employee $user, Employee $employee): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Employee $user, Employee $employee): bool
    {
        return $user->isAdmin();
    }
}
