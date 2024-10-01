<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (now('Asia/Jakarta')->hour === 0 && now('Asia/Jakarta')->minute === 0) { 
            // Tambahkan refresh halaman satu kali sebelum logout
            echo "<script>if (!sessionStorage.getItem('reloaded')) { sessionStorage.setItem('reloaded', 'true'); location.reload(); }</script>";
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
        $users = User::all();
        return view('pages.user.manage_user', compact('users'));
    }
    
    public function create()
{
    return view('pages.user.add_role'); // sesuaikan dengan nama view yang kamu gunakan
}


    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('manage_user.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'nullable', // Ubah menjadi nullable
        ]);
        $user = User::find($id);
        
        $dataToUpdate = [
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
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
