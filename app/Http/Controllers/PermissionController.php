<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return view('pages.user.permission', compact('permissions'));
    }

    public function create()
    {
        return view('pages.user.create_permission');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission berhasil ditambahkan');
    }

    public function edit(Permission $permission)
    {
        return view('pages.user.edit_permission', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission berhasil diupdate');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission berhasil dihapus');
    }
}
