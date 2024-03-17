<?php

namespace App\Repository\Employee;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAll(): Builder
    {
        $current_user_type = auth()->user()['type'];
        if ($current_user_type == 'manager') {
            return Employee::query()->where('manager_id', auth()->id());
        }
        return Employee::query()->where('type', 'employee');
    }

    public function getByPhoneOrEmail(string $credential): Model|Builder|null|Employee
    {
        return Employee::query()->whereAny(['email', 'phone'], $credential)->first();
    }
    public function getManagers(): Collection|array
    {
        return Employee::query()->where('type', 'manager')->get();
    }
    public function getMyEmployees(): Collection|array
    {
        return auth()->user()['type'] == 'admin' ?
            Employee::query()->where('type', 'employee')->get() :
            Employee::query()->where([
                ['type', 'employee'],
                ['manager_id', auth()->id()]
            ])->get();
    }

    public function create(EmployeeRequest $request, string|null $imageLink): Model|Builder|Employee
    {
        return Employee::query()->create([
            'first_name'    => $request->get('first_name'),
            'last_name'     => $request->get('last_name'),
            'salary'        => $request->get('salary'),
            'email'         => $request->get('email'),
            'phone'         => $request->get('phone'),
            'password'      => bcrypt($request->get('password')),
            'manager_id'    => $request->get('manager_id'),
            'department_id' => $request->get('department_id'),
            'image'         => $imageLink
        ]);
    }

    public function update(EmployeeRequest $request, Employee $employee, string|null $imageLink): Employee
    {
        $employee->update([
            'first_name'    => $request->get('first_name'),
            'last_name'     => $request->get('last_name'),
            'salary'        => $request->get('salary'),
            'email'         => $request->get('email'),
            'phone'         => $request->get('phone'),
            'manager_id'    => $request->get('manager_id'),
            'department_id' => $request->get('department_id'),
            'image'         => $imageLink,
            'password'      => $request->get('password') ?
                bcrypt($request->get('password')) : $employee['password']
        ]);

        return $employee->refresh();
    }

    public function delete(Employee $employee): ?bool
    {
        return $employee->delete();
    }
}
