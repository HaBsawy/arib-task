<?php

namespace App\Repository\Task;

use App\Http\Requests\TaskRequest;
use App\Models\Task;

interface TaskRepositoryInterface
{
    public function getAll();
    public function create(TaskRequest $request);
    public function update(TaskRequest $request, Task $task);
    public function delete(Task $task);
}
