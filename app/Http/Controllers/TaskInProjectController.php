<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Board;
use App\Models\Project;
use App\Models\TaskLabel;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use App\Models\TaskPriority;
use Illuminate\Support\Carbon;
use App\Models\History;
use App\Models\Task; // Tambahkan import model Task
use Illuminate\Support\Facades\Auth; // Tambahkan import untuk autentikasi

class TaskInProjectController extends Controller
{
    public function show(Request $request, $id)
    {
        $board = Board::all();
        $status = TaskStatus::all();
        $priority = TaskPriority::all();
        $label = TaskLabel::all();
        $users = User::all();
        $project = Project::all();
        // Validasi untuk admin atau manajer
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'manager') {
            // Ambil semua task untuk project
            $tasks = Task::where('project_id', $id)->get();
        } else {
            // Ambil task sesuai dengan akun pengguna
            $tasks = app(DashboardController::class)->getTasksByUser(Auth::id());
        }

        // Hitung waktu dari 00:00:00 dan tambahkan totalTime
        $startOfDay = Carbon::today()->startOfDay();
        $endOfDay = Carbon::today()->endOfDay();
        $totalTime = 0; // Inisialisasi totalTime

        $tasksWithTime = $tasks->map(function ($taskItem) use (&$totalTime) {
            $timeData = History::calculateTotalTime($taskItem->name); // Ambil totalTime dan elapsedTime
            $totalTime = $timeData['totalTime'];
            $elapsedTime = $timeData['elapsedTime'];

            $startOfDay = Carbon::today()->startOfDay();
            $endOfDay = Carbon::today()->endOfDay();
            $remainingTime = $endOfDay->diffInSeconds($startOfDay) - $totalTime;

            $taskItem->remainingTime = $remainingTime; // Waktu tersisa dalam detik
            $taskItem->elapsed_time = $elapsedTime; // Waktu yang telah berlalu dalam detik
            $taskItem->totalTime = $totalTime + $elapsedTime; // Total waktu dalam detik
            $taskItem->isPlaying = $taskItem->timer_status == 'Playing';
            $taskItem->isPaused = $taskItem->timer_status == 'Paused';
            return $taskItem;
        });

        $projects = Project::find($id);

        return view('pages.show_task_in_project', compact('tasks', 'projects', 'board', 'status', 'priority', 'label', 'users', 'project', 'tasksWithTime'));
    }
}
