<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\task_label;
use Illuminate\Http\RedirectResponse;
class StatusController extends Controller
{
    public function index()
    {
        $labels = task_label::all();
        // Logika untuk menampilkan status
        return view('pages.task.labels', compact('status'));
    }

    public function create(): View
    {
        return view('pages.task.labels');
    }

    public function destroy($id): RedirectResponse
    {
        $labels = task_label::find($id);
        $labels->delete();
        return redirect()->route('task_labels.index');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
        ]);

        //create product
        task_label::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('task_labels.index')
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $labels = task_label::findOrFail($id);

        return view('pages.project.edittask_labels', compact('status'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
        ]);

        //get product by ID
        $labels = task_label::findOrFail($id);

        //update product without image
        $labels->update([
            'name' => $request->name,
        ]);

        //redirect to index
        return redirect()
            ->route('task_labels.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }
}
