<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ProjectStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class StatusController extends Controller
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
