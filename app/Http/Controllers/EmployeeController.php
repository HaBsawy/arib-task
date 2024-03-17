<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Repository\Department\DepartmentRepositoryInterface;
use App\Repository\Employee\EmployeeRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Exceptions\Exception;

class EmployeeController extends Controller
{
    private EmployeeRepositoryInterface $employeeRepository;
    private DepartmentRepositoryInterface $departmentRepository;
    private ImageHelper $imageHelper;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        DepartmentRepositoryInterface $departmentRepository,
        ImageHelper $imageHelper
    )
    {
        $this->employeeRepository = $employeeRepository;
        $this->departmentRepository = $departmentRepository;
        $this->imageHelper = $imageHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View|Factory|Application|JsonResponse
     * @throws Exception
     * @throws \Exception
     */
    public function index(): View|Factory|Application|JsonResponse
    {
        if (request()->user()->cannot('viewAny', Employee::class)) {
            abort(403);
        }

        if (request()->ajax()) {
            $employees = $this->employeeRepository->getAll();

            return datatables()->of($employees)
                ->addIndexColumn()
                ->editColumn('department_name', function ($request) {
                    return $request->department?->name;
                })
                ->editColumn('manager_name', function ($request) {
                    return $request->manager?->full_name;
                })
                ->editColumn('created_at', function ($request) {
                    return $request->created_at;
                })
                ->filter(function (Builder $query) {
                    if (request('search.value')) {
                        $query->whereAny(['id', 'first_name', 'last_name', 'salary'], 'LIKE', '%' . request('search.value') . '%')
                            ->orWhereHas('manager', function (Builder $query) {
                            $query
                                ->where('first_name', 'LIKE', '%' . request('search.value') . '%')
                                ->orWhere('last_name', 'LIKE', '%' . request('search.value') . '%');
                        })->orWhereHas('department', function (Builder $query) {
                            $query->where('name', 'LIKE', '%' . request('search.value') . '%');
                        });
                    }
                }, false)->make();
        }
        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        if (request()->user()->cannot('create', Employee::class)) {
            abort(403);
        }

        $employee = new Employee();
        $managers = $this->employeeRepository->getManagers();
        $departments = $this->departmentRepository->getAll();
        return view('employee.form',
            compact('employee', 'managers', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $request
     * @return RedirectResponse
     */
    public function store(EmployeeRequest $request): RedirectResponse
    {
        if (request()->user()->cannot('create', Employee::class)) {
            abort(403);
        }

        $imageLink = $request->file('image') ?
            $this->imageHelper->uploadImage($request) : null;
        $this->employeeRepository->create($request, $imageLink);
        return redirect()->route('employees.index')
            ->with('success', 'Employee is created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return Application|Factory|View
     */
    public function edit(Employee $employee): View|Factory|Application
    {
        if (request()->user()->cannot('update', $employee)) {
            abort(403);
        }

        $managers = $this->employeeRepository->getManagers();
        $departments = $this->departmentRepository->getAll();
        return view('employee.form',
            compact('employee', 'managers', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeRequest $request
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function update(EmployeeRequest $request, Employee $employee): RedirectResponse
    {
        if (request()->user()->cannot('update', $employee)) {
            abort(403);
        }

        if ($request->file('image') && $employee['image'])
            $this->imageHelper->removeImage($employee['image']);

        $imageLink = $request->file('image') ?
            $this->imageHelper->uploadImage($request) : $employee['image'];
        $this->employeeRepository->update($request, $employee, $imageLink);
        return redirect()->route('employees.index')
            ->with('success', 'Employee is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        if (request()->user()->cannot('delete', $employee)) {
            abort(403);
        }

        if ($employee['image'])
            $this->imageHelper->removeImage($employee['image']);

        $this->employeeRepository->delete($employee);
        return back()->with('success', 'Employees is deleted successfully!');
    }
}
