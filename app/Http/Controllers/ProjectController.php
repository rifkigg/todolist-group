<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ProjectStatus;
use App\Models\ProjectCategories;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function index(): View
    {
        //get all products
        $project = Project::with('category', 'status')->paginate(10);

        $total_project = Project::count();

        //render view with products
        return view('pages.project.project', compact('project', 'total_project'));
    }

    public function create(): View
    {
        $categories = ProjectCategories::all();
        $status = ProjectStatus::all();
        return view('pages.project.addProject', compact('categories','status'));
    }

    public function show(string $id): View
    {
        $project = Project::find($id);
        return view('pages.project.showProject', compact('project'));
    }

    public function destroy($id): RedirectResponse
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('project.index');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $request->validate([
            'name' => 'required|min:5',
            'category_id' => 'required',
            'status_id' => 'required',
            'live_date' => 'required',
            'project_detail' => 'required|min:5',
        ]);
    
        // Menghapus tag HTML dari textarea
        $cleanText = strip_tags($request->input('project_detail'));
    
        // Create a new project with sanitized data
        Project::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'status_id' => $request->status_id,
            'live_date' => $request->live_date,
            'project_detail' => $cleanText,
        ]);
    
        // Redirect to index
        return redirect()
            ->route('project.index')
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
