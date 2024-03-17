<?php

namespace App\Repository\Employee;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;

interface EmployeeRepositoryInterface
{
    public function getAll();
    public function getByPhoneOrEmail(string $credential);
    public function getManagers();
    public function getMyEmployees();
    public function create(EmployeeRequest $request, string|null $imageLink);
    public function update(EmployeeRequest $request, Employee $employee, string|null $imageLink);
    public function delete(Employee $employee);
}
