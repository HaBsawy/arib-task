<?php

namespace App\Providers;

use App\Models\Employee;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('edit-department', function (Employee $user) {
            return $user->isAdmin();
        });
        Gate::define('delete-department', function (Employee $user) {
            return $user->isAdmin();
        });
        Gate::define('edit-employee', function (Employee $user) {
            return $user->isAdmin();
        });
        Gate::define('delete-employee', function (Employee $user) {
            return $user->isAdmin();
        });
        Gate::define('edit-task', function (Employee $user) {
            return $user->isAdmin() || $user->isEmployee();
        });
    }
}
