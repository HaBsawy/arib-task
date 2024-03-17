<?php

namespace App\Repository\Department;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function getAll(): Collection
    {
        return Department::all();
    }

    public function create(DepartmentRequest $request): Model|Builder|Department
    {
        return Department::query()->create([
            'name' => $request->get('name')
        ]);
    }

    public function update(DepartmentRequest $request, Department $department): Department
    {
        $department->update([
            'name' => $request->get('name')
        ]);

        return $department->refresh();
    }

    public function delete(Department $department): bool
    {
        if (count($department['employees']) > 0) {
            return false;
        }

        return $department->delete();
    }
}
