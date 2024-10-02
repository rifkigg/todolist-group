<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('pages.user.daftar_user', compact('users'));
    }

    public function editPermissions(User $user)
    {
        $permissions = Permission::all();
        $userPermissions = $user->permissions->pluck('name')->toArray();

        return view('pages.user.edit_daftar_user', compact('user', 'permissions', 'userPermissions'));
    }

    public function updatePermissions(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions);

        return redirect()->route('users.index')->with('success', 'Permissions berhasil diupdate');
    }
}