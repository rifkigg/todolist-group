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
        $priorities = task_priority::all();
        return view('pages.task.prioritiesTask', compact('priorities'));
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
            'icon' => 'required'
        ]);

        task_priority::create([
            'name' => $request->name,
            'icon' => $request->icon
        ]);

        //redirect to index
        return redirect()->route('priorities.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy($id) 
    {
        $priority = task_priority::findOrFail($id);
        
        $priority->delete();
    
        return redirect()->route('priorities.index')->with('success', 'Priority berhasil dihapus.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required'
        ]);

        $priority = task_priority::findOrFail($id);

        $priority->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return redirect()
            ->route('priorities.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }

}