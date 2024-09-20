<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ProjectStatus;
use App\Models\ProjectCategories;
use App\Http\Controllers\Controller;
use App\Models\board;
use App\Models\task;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        //get all products
        $project = Project::with('users', 'category', 'status')->latest()->get();

        $users = User::all();

        $total_project = Project::count();
        $total_user = User::count();
        $total_task = task::count();
        $total_board = board::count();

        $selectedUserId = $request->input('assignee_id');
        $userRole = $request->user()->role;

        if ($userRole === 'admin' || $userRole === 'manajer') {
            $projectQuery = Project::with('category', 'status')->latest();
        } else {
            $projectQuery = Project::with('category', 'status')->whereHas('users', function ($query) use ($request) {
                $query->where('users.id', $request->user()->id);
            });
        }

        $project = $projectQuery->get()->map(function ($project) {
            $project->time_count = json_decode($project->time_count, true)[0] ?? '00:00:00';
            return $project;
        });

        // Ambil semua task untuk setiap project
        $tasks = Project::with('tasks')->get()->flatMap(function ($project) {
            return $project->tasks;
        });

        $projects = Project::with('tasks')->get()->map(function ($project) {
            $totalTasks = $project->tasks->count();
            $completedTasks = $project->tasks->where('timer_status', 'Finished')->count();
            
            $progress = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
            $project->progress = number_format($progress, 0) . ' %'; // Format progress
        
            return $project;
        });

        $total_tasknya = $tasks->count();
        $total_selesai = $tasks->where('timer_status', 'Finished')->count();

        // Cek apakah $total_tasknya tidak nol sebelum melakukan pembagian
        if ($total_tasknya > 0) {
            $persenan = ($total_selesai / $total_tasknya) * 100;
        } else {
            $persenan = 0;
        }
        $format_persenan = number_format($persenan, 0);

        //render view with products
        return view('pages.project.project', compact('users', 'project', 'total_project', 'total_user', 'total_task', 'total_board', 'selectedUserId', 'format_persenan', 'tasks', 'total_tasknya', 'total_selesai', 'projects' ));
    }

    public function create()
    {
        $categories = ProjectCategories::all();
        $status = ProjectStatus::all();
        $users = User::all();
        $project = new Project();

        return view('pages.project.addProject', compact('categories', 'status', 'users', 'project'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5',
            'category_id' => 'required',
            'status_id' => 'required',
            'live_date' => 'required',
            'project_detail' => 'required|min:5',
            'assignees' => 'array',
            'assignees.*' => 'exists:users,id',
        ]);

        $project = Project::create($validatedData);
        $project->users()->sync($request->assignees); // Menyimpan assignees

        return redirect()->route('project.index');
    }

    public function show(string $id): View
    {
        $project = Project::find($id);
        return view('pages.project.showProject', compact('project'));
    }

    public function edit(string $id): View
    {
        $project = Project::find($id);
        $categories = ProjectCategories::all();
        $status = ProjectStatus::all();
        $users = User::all();
        return view('pages.project.editProject', compact('users', 'project', 'categories', 'status'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validate form
        $request->validate([
            'name' => 'required|min:5',
            'category_id' => 'required',
            'status_id' => 'required',
            'live_date' => 'required',
            'project_detail' => 'required|min:5',
        ]);

        //get project by ID
        $project = Project::findOrFail($id);

        $cleanText = strip_tags($request->input('project_detail'));

        //update project without image
        $project->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'status_id' => $request->status_id,
            'live_date' => $request->live_date,
            'project_detail' => $request->project_detail,
        ]);

        $project->users()->sync($request->assignees);

        //redirect to index
        return redirect()
            ->route('project.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('project.index');
    }

    public function duplicate($id)
    {
        $project = Project::findOrFail($id);

        $newProject = $project->replicate();
        $newProject->name = $project->name . ' (Copy)';
        $newProject->created_at = now();
        $newProject->save();

        return redirect()->route('project.index')->with('success', 'Project duplicated successfully!');
    }

    public function getProjectByUser($userId)
    {
        $projects = Project::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return $projects;
    }
}
