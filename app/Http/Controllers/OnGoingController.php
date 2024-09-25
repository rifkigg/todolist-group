<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnGoingController extends Controller
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

        // Ambil tugas yang sedang dimainkan atau yang terakhir diambil oleh setiap pengguna
        $activeTasks = [];
        foreach ($users as $user) {
            $tasks = $user->tasks()->where('timer_status', 'Playing')->get(); // Tugas yang sedang dimainkan
            
            if ($tasks->isNotEmpty()) {
                foreach ($tasks as $task) {
                    $activeTasks[] = [
                        'user' => $user->username,
                        'task' => $task->name,
                        'user_id' => $user->id, // Tambahkan user_id
                        'status' => $task->timer_status,
                        'time' => History::calculateTotalTime($task->name), // Hitung waktu total
                        'created_at' => $task->created_at,
                    ];
                }
            } else {
                // Tampilkan tugas terakhir yang diambil, tanpa mempedulikan status
                $lastTask = $user->tasks()->orderBy('updated_at', 'desc')->first(); // Tugas terakhir yang diambil
                if ($lastTask) {
                    $activeTasks[] = [
                        'user' => $user->username,
                        'task' => $lastTask->name,
                        'user_id' => $user->id, // Tambahkan user_id
                        'status' => $lastTask->timer_status,
                        'time' => History::calculateTotalTime($lastTask->name), // Hitung waktu total
                        'created_at' => $lastTask->created_at,
                    ];
                } else {
                    // Jika tidak ada tugas, tampilkan nama pengguna saja dengan null untuk task, status, dan time
                    $activeTasks[] = [
                        'user' => $user->username,
                        'user_id' => $user->id, // Tambahkan user_id
                        'task' => null,
                        'status' => null,
                        'time' => null,
                        'created_at' => null,
                    ];
                }
            }
        }
        // dd($activeTasks);

        return view('pages.on_going', compact('users', 'activeTasks'));
    }
}