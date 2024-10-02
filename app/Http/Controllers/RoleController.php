<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        if (now('Asia/Jakarta')->hour === 0 && now('Asia/Jakarta')->minute === 0) {
            // Tambahkan refresh halaman satu kali sebelum logout
            echo "<script>if (!sessionStorage.getItem('reloaded')) { sessionStorage.setItem('reloaded', 'true'); location.reload(); }</script>";
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
    
        $roles = Role::all(); // Make sure roles are defined here
        return view('pages.user.add_role', compact('roles'));
    }
    
    public function create(): View
    {
        $roles = Role::all(); // Add roles variable here
        return view('pages.user.add_role', compact('roles')); // Pass roles to the view
    }

    public function destroy($id): RedirectResponse
    {
        $roles = Role::find($id);
        $roles->delete();
        return redirect()->route('roles.index');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
        ]);

        //create role
        Role::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('roles.index')
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $roles = Role::findOrFail($id);

        return view('pages.roles.editroles', compact('roles'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
        ]);

        //get role by ID
        $roles = Role::findOrFail($id);

        //update role without image
        $roles->update([
            'name' => $request->name,
        ]);

        //redirect to index
        return redirect()
            ->route('roles.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function delete($id): RedirectResponse
{
    $role = Role::find($id);
    if ($role) {
        $role->delete();
        return redirect()->route('roles.index')->with(['success' => 'Role berhasil dihapus!']);
    }
    return redirect()->route('roles.index')->with(['error' => 'Role tidak ditemukan!']);
}
}