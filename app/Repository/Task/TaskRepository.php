<?php

namespace App\Repository\Task;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAll()
    {
        $current_user_type = auth()->user()['type'];
        if ($current_user_type == 'employee') {
            return Task::query()->where('employee_id', auth()->id());
        } elseif ($current_user_type == 'manager') {
            return Task::query()->wherehas('employee', function (Builder $query) {
                $query->where('manager_id', auth()->id());
            });
        }
        return Task::query();
    }

    public function create(TaskRequest $request): Model|Builder|Task
    {
        return Task::query()->create([
            'employee_id'   => $request->get('employee_id'),
            'name'          => $request->get('name')
        ]);
    }

    public function update(TaskRequest $request, Task $task): Task
    {
        $task->update([
            'status' => $request->get('status'),
        ]);

        return $task->refresh();
    }

    public function delete(Task $task): ?bool
    {
        return $task->delete();
    }
}
