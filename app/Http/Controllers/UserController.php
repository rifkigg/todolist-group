<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // Tambahkan ini di bagian atas
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (now('Asia/Jakarta')->hour === 0 && now('Asia/Jakarta')->minute === 0) {
            // Tambahkan refresh halaman satu kali sebelum logout
            echo "<script>
                if (!sessionStorage.getItem('reloaded')) {
                    sessionStorage.setItem('reloaded', 'true');
                    location.reload();
                }
            </script>";
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
        $users = User::with('role')->get();
        $roles = Role::all(); // Menambahkan pengambilan semua role
        return view('pages.user.manage_user', compact('users', 'roles')); // Mengirimkan $roles ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'role_id' => 'required', // Memastikan role_id divalidasi
            'password' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id, // Mengirimkan role_id ke database
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('manage_user.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'role_id' => 'required',
            'password' => 'nullable', // Ubah menjadi nullable
        ]);
        $user = User::find($id);

        $dataToUpdate = [
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        // Cek jika password diisi
        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        $user->update($dataToUpdate);
        return redirect()->route('manage_user.index');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
}
