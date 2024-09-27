<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\TaskPriority;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class TaskPrioritiesController extends Controller
{
    public function index(Request $request):View
    {
        if (now('Asia/Jakarta')->hour === 0 && now('Asia/Jakarta')->minute === 0) { 
            // Tambahkan refresh halaman satu kali sebelum logout
            echo "<script>if (!sessionStorage.getItem('reloaded')) { sessionStorage.setItem('reloaded', 'true'); location.reload(); }</script>";
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
        $priorities = TaskPriority::all();
        return view('pages.task.prioritiesTask', compact('priorities'));
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
            'icon' => 'required'
        ]);

        TaskPriority::create([
            'name' => $request->name,
            'icon' => $request->icon
        ]);

        return redirect()->route('priorities.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy($id) 
    {
        $priority = TaskPriority::findOrFail($id);
        
        $priority->delete();
    
        return redirect()->route('priorities.index')->with('success', 'Priority berhasil dihapus.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required'
        ]);

        $priority = TaskPriority::findOrFail($id);

        $priority->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return redirect()
            ->route('priorities.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }

}