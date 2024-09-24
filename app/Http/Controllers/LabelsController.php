<?php

namespace App\Http\Controllers;

use App\Models\TaskLabel;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LabelsController extends Controller // {{ edit_1 }}
{
    public function index(Request $request): View
    {
        if (now('Asia/Jakarta')->hour === 0 && now('Asia/Jakarta')->minute === 0) { //jam 5 sore menurut UTC jika di jakarta itu jam 12 malam
            // Tambahkan refresh halaman satu kali sebelum logout
            echo "<script>if (!sessionStorage.getItem('reloaded')) { sessionStorage.setItem('reloaded', 'true'); location.reload(); }</script>";
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
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