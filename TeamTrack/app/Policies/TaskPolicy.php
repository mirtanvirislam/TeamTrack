<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function completeOrUpdateTask(User $user, Task $task)
    {
        return $user->id==$task->created_by || $user->id==$task->user_id;
    }

    public function updateTask(User $user, Task $task)
    {
        return $user->id==$task->created_by || $user->id==$task->sprint->backlog->team->leader_id;
    }

    public function deleteTask(User $user, Task $task)
    {
        return $user->id==$task->created_by;
    }

}
