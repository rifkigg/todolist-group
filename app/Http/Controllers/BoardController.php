<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\User;
use App\Models\Board;
use App\Models\Project;
use App\Models\TaskLabel;
use App\Models\task_priority;
use Illuminate\View\View;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use App\Models\ProjectStatus;
use App\Models\ProjectCategories;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use App\Models\History;

class BoardController extends Controller
{
    public function index(Request $request): View
    {
        $projectId = $request->input('project_id');
    
        // Jika ada project_id yang dipilih, filter boards berdasarkan project_id tersebut
        if ($projectId) {
            $boards = Board::where('project_id', $projectId)->get();
        } else {
            $boards = Board::all(); // Jika tidak ada project_id yang dipilih, ambil semua boards
        }
    
        $projects = Project::all();
        $task = Task::all();
        $status = TaskStatus::all();
        $priority = task_priority::all();
        $label = TaskLabel::all();
        $users = User::all();
    
        $total_project = Project::count();
        $total_board = Board::count();
        $total_user = User::count();
        $total_task = Task::count();
    
        $board = Board::with('project', 'tasks')
            ->latest()
            ->get()
            ->map(function ($board) {
                // Memodifikasi data untuk setiap board
                $board->tasks = $board->tasks->map(function ($task) {
                    // Dekode JSON dan ambil elemen pertama dari array
                    $time_count = json_decode($task->time_count, true);
                    $task->time_count = isset($time_count[0]) ? $time_count[0] : '00:00:00';

                    // Hitung waktu dari 00:00:00 dan tambahkan totalTime
                    $totalTime = History::calculateTotalTime($task->name);
                    $startOfDay = Carbon::today()->startOfDay();
                    $endOfDay = Carbon::today()->endOfDay();
                    $remainingTime = $endOfDay->diffInSeconds($startOfDay) - $totalTime;
                    $task->totalTime = $totalTime;
                    $task->remainingTime = $remainingTime;
                    $task->isPlaying = $task->timer_status == 'Playing';
                    $task->isPaused = $task->timer_status == 'Paused';

                    return $task;
                });
                return $board;
            });
    
        return view('pages.boards', compact('boards', 'projects', 'total_user', 'task', 'total_board', 'board', 'status', 'priority', 'label', 'users', 'total_project', 'total_task'));
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

    public function destroy($id)
    {
        $boards = Board::findOrFail($id);
        $boards->delete();
        return redirect()->route('boards.index')->with('success', 'Board deleted successfully.');
    }
}