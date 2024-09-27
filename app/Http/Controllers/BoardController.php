<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Board;
use App\Models\History;
use App\Models\Project;
use App\Models\TaskLabel;
use Illuminate\View\View;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use App\Models\TaskPriority;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class BoardController extends Controller
{
    public function index(Request $request): View
    {
        if (now('Asia/Jakarta')->hour === 0 && now('Asia/Jakarta')->minute === 0) { 
            // Tambahkan refresh halaman satu kali sebelum logout
            echo "<script>if (!sessionStorage.getItem('reloaded')) { sessionStorage.setItem('reloaded', 'true'); location.reload(); }</script>";
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
        $projectId = $request->input('project_id');

        // Jika ada project_id yang dipilih, filter boards berdasarkan project_id tersebut
        if ($projectId) {
            $boards = Board::where('project_id', $projectId)->get();
        } else {
            $boards = Board::all(); // Jika tidak ada project_id yang dipilih, ambil semua boards
        }

        $projects = Project::all();
        $tasks = Task::all();
        $status = TaskStatus::all();
        $priority = TaskPriority::all();
        $label = TaskLabel::all();
        $users = User::all();

        $total_project = Project::count();
        $total_board = Board::count();
        $total_user = User::count();
        $total_task = Task::count();

        $board = Board::with('project', 'tasks')->latest()->get();
        $totalTime = 0; // Inisialisasi total waktu sebagai angka

        if ($tasks->isNotEmpty()) {
            foreach ($tasks as $task) {
                $taskTime = History::calculateTotalTime($task->name); // Hitung waktu total untuk tiap task
                if (is_numeric($taskTime)) {
                    $totalTime += $taskTime; // Tambahkan ke total waktu
                }
            }
        }

        // Hitung waktu dari 00:00:00 dan tambahkan totalTime
        $startOfDay = Carbon::today()->startOfDay();
        $endOfDay = Carbon::today()->endOfDay();
        $remainingTime = $endOfDay->diffInSeconds($startOfDay) - $totalTime;

        $tasksWithTime = $tasks->map(function ($task) use ($startOfDay, $endOfDay) {
            $totalTime = History::calculateTotalTime($task->name);
            $remainingTime = $endOfDay->diffInSeconds($startOfDay) - $totalTime;
            $task->totalTime = $totalTime;
            $task->remainingTime = $remainingTime;
            $task->isPlaying = $task->timer_status == 'Playing';
            $task->isPaused = $task->timer_status == 'Paused';
            return $task;
        });

        return view('pages.boards', compact('boards', 'projects', 'total_user', 'tasks', 'total_board', 'status', 'priority', 'label', 'users', 'total_project', 'total_task', 'remainingTime', 'tasksWithTime', 'totalTime'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'board_name' => 'required',
            'project_id' => 'required',
        ]);

        Board::create([
            'board_name' => $request->board_name,
            'project_id' => $request->project_id,
        ]);

        return redirect()
            ->back()
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'board_name' => 'required',
            'project_id' => 'required',
        ]);
        $boards = Board::findOrFail($id);

        $boards->update([
            'board_name' => $request->board_name,
            'project_id' => $request->project_id,
        ]);
        return redirect()
            ->back()
            ->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy($id)
    {
        $boards = Board::findOrFail($id);
        $boards->delete();
        return redirect()
            ->back()
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
