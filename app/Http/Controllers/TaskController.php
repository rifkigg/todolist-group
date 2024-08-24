<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index() 
    {
        $task = task::all();
        $total_project = Project::count();
        $total_user = User::count();
        $total_task = task::count();
        return view('pages.task.task', compact('task', 'total_project', 'total_user', 'total_task'));
    }

    public function destroy($id): RedirectResponse
    {
        $task = task::find($id);
        $task->delete();
        return redirect()->route('task.index');
    }

    public function duplicate($id)
    {
        $task = task::findOrFail($id);

        $newTask = $task->replicate();
        $newTask->name = $task->name . ' (Copy)';
        $newTask->created_at = now();
        $newTask->save();

        return redirect()->route('task.index')->with('success', 'Project duplicated successfully!');
    }
}
