<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskChecklist;
use Illuminate\Http\RedirectResponse;

class TaskChecklistController extends Controller
{
    public function store(Request $request) :RedirectResponse
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'name' => 'required',
        ]);

        TaskChecklist::create([
            'task_id' => $request->task_id,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Checklist added successfully!');
    }
}
