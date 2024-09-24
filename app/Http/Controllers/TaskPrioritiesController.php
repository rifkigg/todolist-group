<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\task_priority;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class TaskPrioritiesController extends Controller
{
    public function index(Request $request):View
    {
        if (now()->hour === 17) { //jam 5 sore menurut UTC jika di jakarta itu jam 12 malam
            // Tambahkan refresh halaman satu kali sebelum logout
            echo "<script>if (!sessionStorage.getItem('reloaded')) { sessionStorage.setItem('reloaded', 'true'); location.reload(); }</script>";
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
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