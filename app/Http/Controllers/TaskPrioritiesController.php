<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\task_priority;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TaskPrioritiesController extends Controller
{
    public function index():View
    {
        $priorities = TaskPriorities::all();
        return view('pages.task.prioritiesTask', compact('priorities'));
    }
}
