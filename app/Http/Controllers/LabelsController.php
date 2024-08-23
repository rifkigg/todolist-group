<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TaskLabel;
use Illuminate\Http\RedirectResponse;

class LabelsController extends Controller // {{ edit_1 }}
{
    public function index()
    {
        $labels = TaskLabel::all();
        // Logika untuk menampilkan status
        return view('pages.task.labelsTask', compact('labels')); // {{ edit_2 }}
    }

    public function create(): View
    {
        return view('pages.task.labelsTask');
    }

    public function destroy($id): RedirectResponse
    {
        $labels = TaskLabel::find($id);
        $labels->delete();
        return redirect()->route('labels.index');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
        ]);

        //create product
        TaskLabel::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('labels.index')
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $labels = TaskLabel::findOrFail($id);

        return view('pages.task.editlabelsTask', compact('labels')); // {{ edit_3 }}
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
        ]);

        //get product by ID
        $labels = TaskLabel::findOrFail($id);

        //update product without image
        $labels->update([
            'name' => $request->name,
        ]);

        //redirect to index
        return redirect()
            ->route('labels.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }
}