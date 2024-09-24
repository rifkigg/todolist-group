<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;

class OnGoingController extends Controller
{
    public function index()
    {
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
                        'status' => $lastTask->timer_status,
                        'time' => History::calculateTotalTime($lastTask->name), // Hitung waktu total
                        'created_at' => $lastTask->created_at,
                    ];
                } else {
                    // Jika tidak ada tugas, tampilkan nama pengguna saja dengan null untuk task, status, dan time
                    $activeTasks[] = [
                        'user' => $user->username,
                        'task' => null,
                        'status' => null,
                        'time' => null,
                        'created_at' => null,
                    ];
                }
            }
        }

        return view('pages.on_going', compact('users', 'activeTasks'));
    }
}