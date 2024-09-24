<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use App\Models\User;
use App\Models\board;
use App\Models\project;
use App\Models\TaskStatus;
use App\Models\History;
use App\Models\task_priority;
use App\Models\TaskLabel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (now()->hour === 17) {
            //jam 5 sore menurut UTC jika di jakarta itu jam 12 malam
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
        // Mengambil data dari berbagai model

        $project = Project::all();
        $board = Board::all();
        $status = TaskStatus::all();
        $priority = task_priority::all();
        $label = TaskLabel::all();
        $users = User::all();

        
        // Ambil tasks yang ditugaskan ke user yang sedang login
        $tasks = app(DashboardController::class)->getTasksByUser(auth()->id())
        ->sortBy(function ($task) {
            return Carbon::parse($task->due_date);
        })
        ;
        // $tasks = app(DashboardController::class)->getTasksByUser(auth()->id());
        $projects = app(ProjectController::class)->getProjectByUser(auth()->id());
        $total_tasknya = $tasks->count();
        $total_selesai = $tasks->where('timer_status', 'Finished')->count();
        $total_belum_selesai = $tasks->where('timer_status', '!=', 'Finished')->count();

        // Cek apakah $total_tasknya tidak nol sebelum melakukan pembagian
        if ($total_tasknya > 0) {
            $persenan = ($total_selesai / $total_tasknya) * 100;
        } else {
            $persenan = 0;
        }
        $format_persenan = number_format($persenan, 0);

        $totalTime = 0; // Inisialisasi total waktu sebagai angka

        if ($tasks->isNotEmpty()) {
            foreach ($tasks as $task) {
                $taskTime = History::calculateTotalTime($task->name); // Hitung waktu total untuk tiap task
                // dd($task->name, $taskTime); // Debugging
                if (is_numeric($taskTime)) {
                    $totalTime += $taskTime; // Tambahkan ke total waktu
                }
            }
        }

        // Hitung waktu dari 00:00:00 dan tambahkan totalTime
        $startOfDay = Carbon::today()->startOfDay();
        $endOfDay = Carbon::today()->endOfDay();
        $remainingTime = max(0, $endOfDay->diffInSeconds($startOfDay) - $totalTime); // Pastikan tidak negatif

        $tasksWithTime = $tasks->map(function ($task) {
            $totalTime = History::calculateTotalTime($task->name);
            $startOfDay = Carbon::today()->startOfDay();
            $endOfDay = Carbon::today()->endOfDay();
            $remainingTime = $endOfDay->diffInSeconds($startOfDay) - $totalTime;
            $task->totalTime = $totalTime; // Total waktu dalam detik
            $task->remainingTime = $remainingTime; // Waktu tersisa dalam detik
            $task->isPlaying = $task->timer_status == 'Playing';
            $task->isPaused = $task->timer_status == 'Paused';
            return $task;
        });

        $total_project = $projects->count();
        $total_task = $tasks->count();
        // Mengirim data ke view
        return view('pages.dashboard', compact('total_belum_selesai', 'total_project', 'total_task', 'tasks', 'total_tasknya', 'total_selesai', 'format_persenan', 'board', 'project', 'status', 'priority', 'label', 'users', 'totalTime', 'remainingTime', 'tasksWithTime'));
    }

    public function getTasksByUser($userId)
    {
        $tasks = Task::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return $tasks;
    }
}
