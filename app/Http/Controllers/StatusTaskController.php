<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskStatus;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class StatusTaskController extends Controller
{
    public function index():View
    {
        $status = TaskStatus ::all();
        return view('pages.task.statusTask', compact('status'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name'              => 'required',
            'status_group'       => 'required'
        ]);

        TaskStatus::create([
            'name'              => $request->name,
            'status_group'       => $request->status_group
        ]);

         //redirect to index
        return redirect()->route('task_status.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy($id) 
    {
        $status = TaskStatus::findOrFail($id);
        
        $status->delete();
    
        return redirect()->route('task_status.index')->with('success', 'Kategori berhasil dihapus.');
    }

    public function show(string $id): View
    {
        $status = TaskStatus::findOrFail($id);
        return view('pages.task.editStatusTask', compact('status')); 
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
            'status_group' => 'required'
        ]);

        //get product by ID
        $status = TaskStatus::findOrFail($id);

        //update product without image
        $status->update([
            'name' => $request->name,
            'task_group' => $request->task_group,
        ]);

        //redirect to index
        return redirect()
            ->route('task_status.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }
}