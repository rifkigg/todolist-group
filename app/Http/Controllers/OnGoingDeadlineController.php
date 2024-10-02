<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\History;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnGoingDeadlineController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all tasks sorted by due date with eager loading
        $tasks = Task::with(['status', 'priority', 'users']) // Eager load relationships
            ->orderBy('due_date', 'asc') // Sort by due_date
            ->get(); // Fetch all tasks

        // Group tasks by user
        $tasksByUser = $tasks->groupBy(function ($task) {
            return $task->users->pluck('username')->implode(', ');
        });

        return view('pages.on_goingdeadline', compact('tasksByUser'));
    }
}