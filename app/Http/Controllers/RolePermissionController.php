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
        $role = Role::find($id);
        $allPermissions = Permission::all();

        // Misalkan kita mengelompokkan berdasarkan prefix nama permission
        $dashboardPermissions = $allPermissions->filter(function ($permission) {
            return strpos($permission->name, 'Dashboard') !== false; // Contoh: permission yang mengandung 'dashboard'
        });

        $projectPermissions = $allPermissions->filter(function ($permission) {
            return strpos($permission->name, 'Project') !== false; // Semua permission lainnya
        });

        $taskPermissions = $allPermissions->filter(function ($permission) {
            return strpos($permission->name, 'Task') !== false; // Semua permission lainnya
        });

        $boardPermissions = $allPermissions->filter(function ($permission) {
            return strpos($permission->name, 'Board') !== false; // Semua permission lainnya
        });

        $otherPermissions = $allPermissions->filter(function ($permission) {
            return !(strpos($permission->name, 'Dashboard') !== false || strpos($permission->name, 'Task') !== false || strpos($permission->name, 'Project') !== false || strpos($permission->name, 'Board') !== false); // Semua permission yang bukan Dashboard, Task, atau Project
        });

        return view('pages.user.edit_daftar_role', compact('role', 'dashboardPermissions', 'projectPermissions', 'taskPermissions', 'otherPermissions', 'boardPermissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Ubah nama role jika ada
        if ($request->has('name')) {
            $role->name = $request->name;
            $role->save(); // Simpan perubahan nama role
        }

        // Sinkronisasi permission dengan role
        $role->syncPermissions($request->permissions);

        return redirect()
            ->route('roles.permissions.edit', $role->id)
            ->with('success', 'Permission untuk role berhasil diperbarui');
    }
}
