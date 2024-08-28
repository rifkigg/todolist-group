<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\task;
use App\Models\User;
use App\Models\board;
use App\Models\project;
use App\Models\TaskLabel;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use App\Models\task_priority;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function index()
    {
        $task = Task::with('project', 'board', 'status', 'priority', 'label', 'users')
            ->latest()
            ->get()
            ->map(function ($task) {
                // Decode JSON time_count untuk setiap task
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

        $attachments = [];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                // Simpan file ke storage
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('attachments', $filename, 'public');

                // Tambahkan path ke array attachments
                $attachments[] = $filePath;
            }

            // Mengambil attachments yang sudah ada dan memastikan itu adalah array
            $existingAttachments = json_decode($task->attachments, true) ?? [];

            // Menggabungkan attachments baru dengan yang lama
            $attachments = array_merge($existingAttachments, $attachments);

            // Simpan attachments sebagai JSON ke database
            $task->attachments = json_encode($attachments);
        }

        // Update data task
        $task->update([
            'name' => $request->name,
            'board_id' => $request->board_id,
            'project_id' => $request->project_id,
            'status_id' => $request->status_id,
            'priority_id' => $request->priority_id,
            'task_label_id' => $request->task_label_id,
            'description' => $request->description,
            'activities' => $request->activities,
            'checklist' => $request->checklist,
            'time_count' => $request->time_count,
            'due_date' => $request->due_date,
            'attachments' => $task->attachments, // Pastikan kolom attachments di-update
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
