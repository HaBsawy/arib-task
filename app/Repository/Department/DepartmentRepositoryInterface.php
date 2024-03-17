<?php

namespace App\Repository\Department;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;

interface DepartmentRepositoryInterface
{
    public function getAll();
    public function create(DepartmentRequest $request);
    public function update(DepartmentRequest $request, Department $department);
    public function delete(Department $department);
}
