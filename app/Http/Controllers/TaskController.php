<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\User;
use App\Models\board;
use App\Models\project;
use App\Models\TaskLabel;
use App\Models\Attachment;
use App\Models\TaskStatus;
use App\Models\TaskActivity;
use Illuminate\Http\Request;
use App\Models\task_priority;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $task = Task::with('project', 'board', 'status', 'priority', 'label', 'users', 'attachments', 'activities')
            ->latest()
            ->get()
            ->map(function ($task) {
                $task->time_count = json_decode($task->time_count, true)[0] ?? '00:00:00';
                return $task;
            });

        $project = Project::all();
        $board = Board::all();
        $status = TaskStatus::all();
        $priority = task_priority::all();
        $label = TaskLabel::all();
        $users = User::all();

        $total_project = Project::count();
        $total_board = Board::count();
        $total_user = User::count();
        $total_task = Task::count();

        return view('pages.task.task', compact('task', 'total_project', 'total_user', 'total_task', 'total_board', 'project', 'board', 'status', 'priority', 'label', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'project_id' => 'required',
            'board_id' => 'required',
        ]);

        task::create([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'board_id' => $request->board_id,
        ]);

        return redirect()
            ->route('task.index')
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'name' => 'required',
            'project_id' => 'required',
            'board_id' => 'required',
        ]);

        // Get task by ID
        $task = Task::findOrFail($id);

        // Update data task
        $task->update([
            'name' => $request->name,
            'board_id' => $request->board_id,
            'project_id' => $request->project_id,
            'status_id' => $request->status_id,
            'priority_id' => $request->priority_id,
            'task_label_id' => $request->task_label_id,
            'description' => $request->description,
            'checklist' => $request->checklist,
            'time_count' => $request->time_count,
            'due_date' => $request->due_date,
        ]);

        // Update assignees
        $task->users()->sync($request->assignees);

        return redirect()->route('task.index')->with('success', 'Task updated successfully.');
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
