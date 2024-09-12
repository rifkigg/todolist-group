<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskChecklist;
use Illuminate\Http\RedirectResponse;

class TaskChecklistController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'name' => 'required',
        ]);

        TaskChecklist::create([
            'task_id' => $request->task_id,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Checklist added successfully!')->withFragment('view-' . $request->task_id);
    }

    public function updateCompleted(Request $request)
    {
        $checklist = $request->input('checklist');

        foreach ($checklist as $id => $completed) {
            $item = TaskChecklist::find($id);
            if ($item) {
                $item->completed = $completed;
                $item->save();
                $taskId = $item->task_id; // Simpan task_id untuk fragment
            }
        }

        return redirect()->back()->with('success', 'Checklist items updated successfully.')->withFragment('view-' . $taskId);
    }

    public function destroy($id)
    {
        $checklist = TaskChecklist::find($id);
        $taskId = $checklist->task_id; // Simpan task_id sebelum dihapus
        $checklist->delete();

        // Redirect dengan fragment untuk membuka modal
        return redirect()
            ->back()
            ->with('success', 'Checklist deleted successfully!')
            ->withFragment('view-' . $taskId);
    }
}
