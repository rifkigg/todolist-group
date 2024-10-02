<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Board;
use App\Models\History;
use App\Models\Project;
use App\Models\TaskLabel;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use App\Models\TaskPriority;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if (now('Asia/Jakarta')->hour === 0 && now('Asia/Jakarta')->minute === 0) { 
            // Tambahkan refresh halaman satu kali sebelum logout
            echo "<script>if (!sessionStorage.getItem('reloaded')) { sessionStorage.setItem('reloaded', 'true'); location.reload(); }</script>";
            Auth::guard('web')->logout();   
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
        $board = Board::all();
        $status = TaskStatus::all();
        $priority = TaskPriority::all();
        $label = TaskLabel::all();
        $users = User::all();

        $total_project = Project::count();
        $total_board = Board::count();
        $total_user = User::count();
        $total_task = Task::count();

        $selectedUserId = $request->input('assignee_id');
        $userRole = $request->user()->role; // Ambil role pengguna

        // Filter task berdasarkan role dan created_by
        if ($userRole === 'admin' || $userRole === 'manajer') {
            // Admin dapat melihat semua task
            $taskQuery = Task::with('project', 'board', 'status', 'priority', 'label', 'users', 'attachments', 'activities', 'checklist', 'description')->latest();
        } else {
            // Role lain hanya dapat melihat task yang ditugaskan kepada mereka dan yang mereka buat
            $taskQuery = Task::with('project', 'board', 'status', 'priority', 'label', 'users', 'attachments', 'activities', 'checklist', 'description')
                ->where(function ($query) use ($request) {
                    $query
                        ->whereHas('users', function ($subQuery) use ($request) {
                            $subQuery->where('users.id', $request->user()->id);
                        })
                        ->orWhere('created_by', $request->user()->username); // Menambahkan kondisi untuk created_by
                })
                ->latest();
        }

        $task = $taskQuery->get()->map(function ($task) {
            $task->time_count = json_decode($task->time_count, true)[0] ?? '00:00:00';
            return $task;
        });

        // Hitung waktu total untuk setiap task
        $totalTime = 0; // Inisialisasi total waktu sebagai angka

        if ($task->isNotEmpty()) {
            // Mengganti $tasks dengan $task
            foreach ($task as $taskItem) {
                // Mengganti $tasks dengan $task
                $taskTime = History::calculateTotalTime($taskItem->name); // Hitung waktu total untuk tiap task
                if (is_numeric($taskTime)) {
                    $totalTime += $taskTime; // Tambahkan ke total waktu
                }
            }
        }

        // Hitung waktu dari 00:00:00 dan tambahkan totalTime
        $startOfDay = Carbon::today()->startOfDay();
        $endOfDay = Carbon::today()->endOfDay();
        $remainingTime = max(0, $endOfDay->diffInSeconds($startOfDay) - $totalTime); // Pastikan tidak negatif

        $tasksWithTime = $task->map(function ($taskItem) {
            // Mengganti $tasks dengan $task
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

        $userId = $request->user()->id; // Ambil ID pengguna yang login
        if ($userRole === 'admin' || $userRole === 'manajer') {
            $project = Project::all();
        } else {
            $project = Project::whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })->get();
        }

        return view('pages.task.task', compact('task', 'total_project', 'total_user', 'total_task', 'total_board', 'project', 'board', 'status', 'priority', 'label', 'users', 'selectedUserId', 'tasksWithTime', 'remainingTime', 'totalTime'));
    }
    public function getTasktoBoard()
    {
        $project = Project::all();
        $board = Board::all();
        $status = TaskStatus::all();
        $priority = TaskPriority::all();
        $label = TaskLabel::all();
        $users = User::all();

        $total_project = Project::count();
        $total_board = Board::count();
        $total_user = User::count();
        $total_task = Task::count();

        // Pastikan pengguna terautentikasi
        if (Auth::check()) {
            $user = Auth::user(); // Ambil pengguna yang terautentikasi
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

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'required|integer',
            'priority_id' => 'required|integer',
            'due_date' => 'required|date',
            'assignees' => 'array',
            'assignees.*' => 'integer',
        ]);

        // Tambahkan created_by ke data yang akan disimpan
        $validatedData['created_by'] = Auth::user()->username; // atau auth()->user()->id jika menggunakan ID

        // Simpan tugas
        $task = Task::create($validatedData);

        // Simpan relasi ke task_user
        if (!empty($request->assignees)) {
            $task->users()->attach($request->assignees);
        }

        return redirect()->route('task.index')->with('success', 'Task created successfully.');
    }

    public function storeToBoard(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'required|integer',
            'board_id' => 'required|integer',
            'priority_id' => 'required|integer',
            'due_date' => 'required|date',
            'assignees' => 'array',
            'assignees.*' => 'integer',
        ]);
        $validatedData['created_by'] = Auth::user()->username;

        $task = Task::create($validatedData);
        // Simpan relasi ke task_user
        if (!empty($request->assignees)) {
            $task->users()->attach($request->assignees);
        }
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
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('task.index');
    }

    public function duplicate($id)
    {
        $task = Task::findOrFail($id);

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

        // Pause all other tasks and save their time
        $playingTasks = app(TaskController::class)->getTasksByUser(Auth::id());
        // app(TaskController::class)->getTasksByUser(auth()->id());
        // Task::where('timer_status', 'Playing')->get();
        foreach ($playingTasks as $playingTask) {
            // Simpan waktu total sebelum dipause
            History::create([
                'task_name' => $playingTask->name,
                'paused' => now(),
            ]);
            $playingTask->timer_status = 'Paused';
            $playingTask->save();
        }

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
            'paused' => now(),
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
            $task->totalTime = $totalTime;
            $task->isPlaying = $task->timer_status == 'Playing';
            $task->isPaused = $task->timer_status == 'Paused';
            return $task;
        });

        return view('pages.task.task', compact('tasksWithTime'));
    }
    public function getTasksByUser($userId)
    {
        $tasks = Task::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('timer_status', 'Playing');
        })->get();

        return $tasks;
    }
}