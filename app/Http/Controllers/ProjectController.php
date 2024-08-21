<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function index(): View
    {
        //get all products
        $project = Project::latest()->paginate(10);

        $total_project = Project::count();
        //render view with products
        return view('pages.project.project', compact('project', 'total_project'));
    }

    public function create(): View
    {
        return view('pages.project.addProject');
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
}
