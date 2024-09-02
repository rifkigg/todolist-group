<?php

namespace App\Http\Controllers;

use App\Models\TaskActivity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'task_id' => 'required|exists:tasks,id',
            'activity' => 'required|string',
        ]);

        TaskActivity::create([
            'username' => $request->username,
            'task_id' => $request->task_id,
            'activity' => $request->activity,
        ]);

        return redirect()->back()->with('success', 'Activity added successfully!')->withFragment('view-' . $request->task_id);
    }
}
