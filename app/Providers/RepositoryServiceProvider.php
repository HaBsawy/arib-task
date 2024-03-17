<?php

namespace App\Providers;

use App\Repository\Department\DepartmentRepository;
use App\Repository\Department\DepartmentRepositoryInterface;
use App\Repository\Employee\EmployeeRepository;
use App\Repository\Employee\EmployeeRepositoryInterface;
use App\Repository\Task\TaskRepository;
use App\Repository\Task\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->singleton(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->singleton(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
