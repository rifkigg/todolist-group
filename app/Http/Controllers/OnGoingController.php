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

        // Ambil tugas yang sedang dimainkan atau yang terakhir dipause oleh setiap pengguna
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
                    ];
                }
            } else {
                $finishedTask = $user->tasks()->where('timer_status', 'Finished')->orderBy('updated_at', 'desc')->first(); // Tugas terakhir yang selesai
                if ($finishedTask) {
                    // Jika tidak ada yang sedang dimainkan, tampilkan tugas finished terbaru
                    $activeTasks[] = [
                        'user' => $user->username,
                        'task' => $finishedTask->name,
                        'status' => $finishedTask->timer_status,
                        'time' => History::calculateTotalTime($finishedTask->name), // Hitung waktu total
                    ];
                } else {
                    $pausedTask = $user->tasks()->where('timer_status', 'Paused')->orderBy('updated_at', 'desc')->first(); // Tugas terakhir yang dipause
                    if ($pausedTask) {
                        $activeTasks[] = [
                            'user' => $user->username,
                            'task' => $pausedTask->name,
                            'status' => $pausedTask->timer_status,
                            'time' => History::calculateTotalTime($pausedTask->name), // Hitung waktu total
                        ];
                    } else {
                        // Jika tidak ada tugas, tampilkan nama pengguna saja dengan null untuk task, status, dan time
                        $activeTasks[] = [
                            'user' => $user->username,
                            'task' => null,
                            'status' => null,
                            'time' => null,
                        ];
                    }
                }
            }
        }

        return view('pages.on_going', compact('users', 'activeTasks'));
    }
}