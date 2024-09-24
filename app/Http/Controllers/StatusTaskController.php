<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class StatusTaskController extends Controller
{
    public function index(Request $request):View
    {
        if (now('Asia/Jakarta')->hour === 0 && now('Asia/Jakarta')->minute === 0) { //jam 5 sore menurut UTC jika di jakarta itu jam 12 malam
            // Tambahkan refresh halaman satu kali sebelum logout
            echo "<script>if (!sessionStorage.getItem('reloaded')) { sessionStorage.setItem('reloaded', 'true'); location.reload(); }</script>";
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
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
            'status_group' => $request->status_group,
        ]);

        //redirect to index
        return redirect()
            ->route('task_status.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }
}