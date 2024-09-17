<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\User;
use App\Models\board;
use App\Models\project;
use App\Models\History;
use App\Models\TaskLabel;
use App\Models\Attachment;
use App\Models\TaskStatus;
use App\Models\TaskActivity;
use Illuminate\Http\Request;
use App\Models\task_priority;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $project = Project::all();
        $board = Board::all();
        $status = TaskStatus::all();
        $priority = task_priority::all();
        $label = TaskLabel::all();
        $users = User::all();

        $total_project = Project::count();
        $total_board = Board::count();
        $total_user = User::count();
        $total_task = Task::count();

        $selectedUserId = $request->input('assignee_id');
        $userRole = $request->user()->role; // Ambil role pengguna

        // Filter task berdasarkan role
        if ($userRole === 'admin' || $userRole === 'manajer' ) {
            // Admin dapat melihat semua task
            $taskQuery = Task::with('project', 'board', 'status', 'priority', 'label', 'users', 'attachments', 'activities', 'checklist', 'description')->latest();
        } else {
            // Role lain hanya dapat melihat task yang ditugaskan kepada mereka
            $taskQuery = Task::with('project', 'board', 'status', 'priority', 'label', 'users', 'attachments', 'activities', 'checklist', 'description')
                ->whereHas('users', function ($query) use ($request) {
                    $query->where('users.id', $request->user()->id);
                })->latest();
        }

        $task = $taskQuery->get()->map(function ($task) {
            $task->time_count = json_decode($task->time_count, true)[0] ?? '00:00:00';
            return $task;
        });

               // Hitung waktu total untuk setiap task
               $totalTime = 0; // Inisialisasi total waktu sebagai angka

               if ($task->isNotEmpty()) { // Mengganti $tasks dengan $task
                   foreach ($task as $taskItem) { // Mengganti $tasks dengan $task
                       $taskTime = History::calculateTotalTime($taskItem->name); // Hitung waktu total untuk tiap task
                       if (is_numeric($taskTime)) {
                           $totalTime += $taskTime; // Tambahkan ke total waktu
                       }
                   }
               }
       
               // Hitung waktu dari 00:00:00 dan tambahkan totalTime
               $startOfDay = Carbon::today()->startOfDay();
               $endOfDay = Carbon::today()->endOfDay();
               $remainingTime = $endOfDay->diffInSeconds($startOfDay) - $totalTime;
       
               $tasksWithTime = $task->map(function ($taskItem) { // Mengganti $tasks dengan $task
                   $totalTime = History::calculateTotalTime($taskItem->name);
                   $startOfDay = Carbon::today()->startOfDay();
                   $endOfDay = Carbon::today()->endOfDay();
                   $remainingTime = $endOfDay->diffInSeconds($startOfDay) - $totalTime;
                   $taskItem->totalTime = $totalTime;
                   $taskItem->remainingTime = $remainingTime;
                   $taskItem->isPlaying = $taskItem->timer_status == 'Playing';
                   $taskItem->isPaused = $taskItem->timer_status == 'Paused';
                   return $taskItem;
               });

        return view('pages.task.task', compact('task', 'total_project', 'total_user', 'total_task', 'total_board', 'project', 'board', 'status', 'priority', 'label', 'users', 'selectedUserId', 'tasksWithTime', 'remainingTime'));
    }
    public function getTasktoBoard()
    {
        $project = Project::all();
        $board = Board::all();
        $status = TaskStatus::all();
        $priority = task_priority::all();
        $label = TaskLabel::all();
        $users = User::all();

        $total_project = Project::count();
        $total_board = Board::count();
        $total_user = User::count();
        $total_task = Task::count();

        // Pastikan pengguna terautentikasi
        if (auth()->check()) {
            $user = auth()->user(); // Ambil pengguna yang terautentikasi
            $userRole = $user->role; // Ambil role pengguna

            $boards = $board->map(function ($board) use ($userRole, $user) {
                // Filter berdasarkan role
                if ($userRole === 'admin') {
                    // Admin dapat melihat semua task
                    $board->tasks = Task::with('project', 'status', 'priority', 'label', 'users', 'attachments', 'activities', 'checklist', 'description')
                        ->where('board_id', $board->id)
                        ->latest()
                        ->get();

                    dd($board->tasks); // Cek hasil query
                } elseif ($userRole === 'developer') {
                    // Developer hanya dapat melihat task yang ditugaskan kepada mereka
                    $board->tasks = Task::with('project', 'status', 'priority', 'label', 'users', 'attachments', 'activities', 'checklist', 'description')
                        ->where('board_id', $board->id)
                        ->whereHas('users', function ($query) use ($user) {
                            $query->where('users.id', $user->id);
                        })
                        ->latest()
                        ->get();
                } elseif ($userRole === 'manajer') {
                    // Manajer dapat melihat semua task seperti admin
                    $board->tasks = Task::with('project', 'status', 'priority', 'label', 'users', 'attachments', 'activities', 'checklist', 'description')
                        ->where('board_id', $board->id) // Menghapus filter proyek
                        ->latest()
                        ->get();
                } elseif ($userRole === 'editor') {
                    // Editor hanya dapat melihat task yang dapat mereka edit
                    $board->tasks = Task::with('project', 'status', 'priority', 'label', 'users', 'attachments', 'activities', 'checklist', 'description')
                        ->where('board_id', $board->id)
                        ->where('editable_by', $user->id) // Misalkan ada kolom yang menunjukkan siapa yang dapat mengedit
                        ->latest()
                        ->get();
                } else {
                    // Role tidak dikenali, bisa mengembalikan array kosong atau pesan error
                    $board->tasks = [];
                }

                return $board;
            });
        } else {
            // Tangani kasus jika pengguna tidak terautentikasi
            $boards = []; // Atau bisa mengembalikan pesan error
        }


        $task = Task::all()->map(function ($task) {
            $task->time_count = json_decode($task->time_count, true)[0] ?? '00:00:00';
            return $task;
        });

        return view('pages.boards', compact('total_project', 'total_user', 'total_task', 'total_board', 'project', 'boards', 'status', 'priority', 'label', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'project_id' => 'required',
            'board_id' => 'required',
        ]);

        task::create([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'board_id' => $request->board_id,
        ]);

        return redirect()
            ->route('task.index')
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function storeToBoard(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'project_id' => 'required',
            'board_id' => 'required',
        ]);

        task::create([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'board_id' => $request->board_id,
        ]);

        return redirect()
            ->back()
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'name' => 'required',
            'project_id' => 'required',
            'board_id' => 'required',
        ]);

        // Get task by ID
        $task = Task::findOrFail($id);

        // Update data task
        $task->update([
            'name' => $request->name,
            'board_id' => $request->board_id,
            'project_id' => $request->project_id,
            'status_id' => $request->status_id,
            'priority_id' => $request->priority_id,
            'task_label_id' => $request->task_label_id,
            'time_count' => $request->time_count,
            'due_date' => $request->due_date,
        ]);

          // Update assignees
        $task->users()->sync($request->assignees);

        return redirect()->route('task.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $task = task::find($id);
        $task->delete();
        return redirect()->route('task.index');
    }

    public function duplicate($id)
    {
        $task = task::findOrFail($id);

        $newTask = $task->replicate();
        $newTask->name = $task->name . ' (Copy)';
        $newTask->created_at = now();
        $newTask->save();

        return redirect()->route('task.index')->with('success', 'Project duplicated successfully!');
    }

    public function start(Request $request)
    {
        $taskName = $request->input('task_name');
        $task = Task::where('name', $taskName)->first();
        $task->timer_status = 'Playing';
        $task->save();

        History::create([
            'task_name' => $taskName,
            'start' => now(),
        ]);

        return redirect()->back();
    }

    public function pause(Request $request)
    {
        $taskName = $request->input('task_name');
        $task = Task::where('name', $taskName)->first();
        $task->timer_status = 'Paused';
        $task->save();

        History::create([
            'task_name' => $taskName,
            'paused' => now(),
        ]);

        return redirect()->back();
    }

    public function finish(Request $request)
    {
        $taskName = $request->input('task_name');
        $task = Task::where('name', $taskName)->first();
        $task->timer_status = 'Finished';
        $task->save();

        History::create([
            'task_name' => $taskName,
            'finish' => now(),
        ]);

        return redirect()->back();
    }

    public function calculateTaskTimes()
{
    $tasks = Task::all();

    $tasksWithTime = $tasks->map(function ($task) {
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

    return view('pages.task.task', compact('tasksWithTime'));
}
}
