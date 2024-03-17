<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Repository\Employee\EmployeeRepositoryInterface;
use App\Repository\Task\TaskRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Exceptions\Exception;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepository;
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        EmployeeRepositoryInterface $employeeRepository
    )
    {
        $this->taskRepository = $taskRepository;
        $this->employeeRepository = $employeeRepository;
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
        if (request()->ajax()) {
            $tasks = $this->taskRepository->getAll();

            return datatables()->of($tasks)
                ->addIndexColumn()
                ->editColumn('employee_name', function ($request) {
                    return $request->employee?->full_name;
                })
                ->filter(function ($query) {
                    if (request('search.value')) {
                        $query->orWhereHas('employee', function (Builder $query) {
                                $query
                                    ->where('first_name', 'LIKE', '%' . request('search.value') . '%')
                                    ->orWhere('last_name', 'LIKE', '%' . request('search.value') . '%');
                            });
                    }
                }, true)->make();
        }
        return view('task.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        if (request()->user()->cannot('create', Task::class)) {
            abort(403);
        }

        $task = new Task();
        $employees = $this->employeeRepository->getMyEmployees();
        return view('task.create', compact('task', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return RedirectResponse
     */
    public function store(TaskRequest $request): RedirectResponse
    {
        if (request()->user()->cannot('create', Task::class)) {
            abort(403);
        }

        $this->taskRepository->create($request);
        return redirect()->route('tasks.index')
            ->with('success', 'task is created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return Application|Factory|View
     */
    public function edit(Task $task): View|Factory|Application
    {
        if (request()->user()->cannot('update', $task)) {
            abort(403);
        }

        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        if (request()->user()->cannot('update', $task)) {
            abort(403);
        }

        $this->taskRepository->update($request, $task);
        return redirect()->route('tasks.index')
            ->with('success', 'task is updated successfully');
    }
}
