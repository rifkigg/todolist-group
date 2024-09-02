<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskDescription;

class TaskDescriptionController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'task_id' => 'required',
        ]);

        TaskDescription::create([
            'name' => $request->name,
            'task_id' => $request->task_id,
        ]);
        return redirect()
            ->back()
            ->with('success', 'Description updated successfully!')
            ->withFragment('view-' . $id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'task_id' => 'required',
        ]);

        $description = TaskDescription::findOrFail($id);

        $description->update([
            'name' => $request->name,
            'task_id' => $request->task_id,
        ]);
        return redirect()
            ->route('task.index')
            ->with('success', 'Description has been updated.')
            ->with('success_id', $description->task_id) // Simpan task_id dalam session
            ->withFragment('view-' . $description->task_id); // Tambahkan fragment ke URL
    }
}
