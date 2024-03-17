<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Repository\Department\DepartmentRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Exceptions\Exception;

class DepartmentController extends Controller
{
    private DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
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
        if (request()->user()->cannot('viewAny', Department::class)) {
            abort(403);
        }

        if (request()->ajax()) {
            $departments = Department::query();

            return datatables()->of($departments)
                ->addIndexColumn()
                ->editColumn('created_at', function ($request) {
                    return $request->created_at;
                })
                ->editColumn('employees_count', function ($request) {
                    return count($request->employees);
                })
                ->editColumn('salary_sum', function ($request) {
                    return $request->employees->sum('salary');
                })
                ->make();
        }
        return view('department.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        if (request()->user()->cannot('create', Department::class)) {
            abort(403);
        }

        $department = new Department();
        return view('department.form', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentRequest $request
     * @return RedirectResponse
     */
    public function store(DepartmentRequest $request): RedirectResponse
    {
        if (request()->user()->cannot('create', Department::class)) {
            abort(403);
        }

        $this->departmentRepository->create($request);
        return redirect()->route('departments.index')
            ->with('success', 'department is created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return Application|Factory|View
     */
    public function edit(Department $department): View|Factory|Application
    {
        if (request()->user()->cannot('update', $department)) {
            abort(403);
        }

        return view('department.form', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentRequest $request
     * @param Department $department
     * @return RedirectResponse
     */
    public function update(DepartmentRequest $request, Department $department): RedirectResponse
    {
        if (request()->user()->cannot('update', $department)) {
            abort(403);
        }

        $this->departmentRepository->update($request, $department);
        return redirect()->route('departments.index')
            ->with('success', 'department is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return RedirectResponse
     */
    public function destroy(Department $department): RedirectResponse
    {
        if (request()->user()->cannot('delete', $department)) {
            abort(403);
        }

        $this->departmentRepository->delete($department);
        return back()->with('success', 'department is deleted successfully!');
    }
}
