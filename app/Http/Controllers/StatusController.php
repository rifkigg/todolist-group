<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectStatus;
use Illuminate\Http\RedirectResponse;
class StatusController extends Controller
{
    public function index()
    {
        $status = ProjectStatus::all();
        // Logika untuk menampilkan status
        return view('pages.project.statusProject', compact('status'));
    }

    public function create(): View
    {
        return view('pages.project.statusProject');
    }

    public function destroy($id): RedirectResponse
    {
        $status = ProjectStatus::find($id);
        $status->delete();
        return redirect()->route('project_status.index');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
        ]);

        //create product
        ProjectStatus::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('project_status.index')
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $status = ProjectStatus::findOrFail($id);

        return view('pages.project.editProjectStatus', compact('status'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
        ]);

        //get product by ID
        $status = ProjectStatus::findOrFail($id);

        //update product without image
        $status->update([
            'name' => $request->name,
        ]);

        //redirect to index
        return redirect()
            ->route('project_status.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }
}
