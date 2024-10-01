<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;

class TaskPerUserController extends Controller
{
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        // Cek apakah ada entri di tabel History untuk waktu sekarang
        $currentHistories = History::whereDate('created_at', now()->toDateString())
            ->get(); // Ambil semua history yang sesuai

            if ($currentHistories->isEmpty()) {
                $user = User::find($id);
                $activeTasks = []; // Inisialisasi activeTasks
                return view('pages.task_per_user', compact('user', 'activeTasks')); // Jika tidak ada, kembalikan view kosong
                $activeTasks = []; // Inisialisasi activeTasks
            }

        $activeTasks = [];
        $latestHistories = []; // Array untuk menyimpan history terbaru berdasarkan task name

        // Loop untuk mengumpulkan history terbaru
        foreach ($currentHistories as $history) {
            $taskName = $history->task_name; // Ambil nama task
            $task = $history->task; // Asumsi ada relasi ke model Task
            $user = User::findorFail($id); // Ambil user terkait

            // Cek apakah sudah ada entri untuk task ini
            if (!isset($latestHistories[$taskName]) || $latestHistories[$taskName]->created_at < $history->created_at) {
                $latestHistories[$taskName] = $history; // Simpan history terbaru
            }
        }

        // Loop untuk menambahkan ke activeTasks
        foreach ($latestHistories as $history) {
            $task = $history->task; // Ambil task terkait
            $user = User::findorFail($id); // Ambil user terkait
            // dd($user);

            // Cek apakah task terkait dengan user ini
            if ($task && $task->users->contains($user->id)) {
                $activeTasks[] = [
                    'user' => $user->username,
                    'task' => $task->name,
                    'status' => $task->timer_status,
                    'total_time' => [
                        'totalTime' => History::calculateTotalTime($task->name)['totalTime'] +  History::calculateTotalTime($task->name)['elapsedTime'], // Ganti 'total_time' menjadi 'totalTime'
                        'elapsedTime' => History::calculateTotalTime($task->name)['elapsedTime'],
                    ],
                    'created_at' => $task->created_at,
                ];
            }
        }

        // dd($user);

        return view('pages.task_per_user', compact('activeTasks', 'user'));
    }
}
