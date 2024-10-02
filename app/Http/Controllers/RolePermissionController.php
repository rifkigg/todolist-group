<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('pages.user.add_role', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Role berhasil ditambahkan');
    }

    public function assignPermission(Request $request)
    {
        $role = Role::findById($request->role_id);
        $permission = Permission::findById($request->permission_id);

        $role->givePermissionTo($permission);

        return redirect()->back()->with('success', 'Permission berhasil diberikan ke role');
    }

    // Method untuk menambahkan permission baru
    public function createPermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Permission berhasil ditambahkan');
    }
    public function edit($id)
    {
        $role = Role::findOrFail($id); // Temukan role berdasarkan ID
        $permissions = Permission::all(); // Dapatkan semua permission
        return view('pages.user.edit_daftar_role', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Sinkronisasi permission dengan role
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.permissions.edit', $role->id)
            ->with('success', 'Permission untuk role berhasil diperbarui');
    }
}
