<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use App\Models\User;
use App\Models\board;
use App\Models\project;

class DashboardController extends Controller
{
    public function index()
    {
        $total_project = Project::count();
        $total_user = User::count();
        $total_task = Task::count();
        $total_board = Board::count();
        $tasks = app(DashboardController::class)->getTasksByUser(auth()->id()); // Fetch tasks assigned to the authenticated user
        $total_tasknya = $tasks->count();
        $total_selesai = $tasks->where('timer_status', 'Finished')->count();
        $persenan = ($total_selesai / $total_tasknya) * 100;
        $format_persenan = number_format($persenan, 0);

        return view('pages.dashboard', compact('total_project', 'total_user', 'total_task', 'total_board', 'tasks', 'total_tasknya', 'total_selesai', 'format_persenan'));
    }
    public function getTasksByUser($userId)
    {
        $tasks = Task::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return $tasks;
    }
}