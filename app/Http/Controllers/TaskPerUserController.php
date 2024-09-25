<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Added for Carbon usage

class TaskPerUserController extends Controller
{
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        // dd(now()->format( 'H:i:s' ), now()->toDateString());
        // dd();
        // Cek apakah ada entri di tabel History untuk waktu sekarang
        $currentHistories = History::whereDate('created_at', now()->toDateString())
            ->get(); // Ambil semua history yang sesuai
        // dd($currentHistories);
        if ($currentHistories->isEmpty()) {
            return view('pages.task_per_user', ['activeTasks' => []]); // Jika tidak ada, kembalikan view kosong
        }

        $activeTasks = [];
        $latestHistories = []; // Array untuk menyimpan history terbaru berdasarkan task name

        // Loop untuk mengumpulkan history terbaru
        foreach ($currentHistories as $history) {
            $taskName = $history->task_name; // Ambil nama task
            $task = $history->task; // Asumsi ada relasi ke model Task

            // Cek apakah sudah ada entri untuk task ini
            if (!isset($latestHistories[$taskName]) || $latestHistories[$taskName]->created_at < $history->created_at) {
                $latestHistories[$taskName] = $history; // Simpan history terbaru
            }
        }

        // Loop untuk menambahkan ke activeTasks
        foreach ($latestHistories as $history) {
            $task = $history->task; // Ambil task terkait
            $user = User::find($id); // Ambil user terkait

            // Cek apakah task terkait dengan user ini
            if ($task->users->contains($user->id)) { // Pastikan relasi users sudah ada
                $activeTasks[] = [
                    'user' => $user->username,
                    'task' => $task->name,
                    'status' => $task->timer_status,
                    'time' => History::calculateTotalTime($task->name), // Hitung waktu total
                    'created_at' => $task->created_at,
                ];
            }
        }

        return view('pages.task_per_user', compact('activeTasks'));
    }
}
