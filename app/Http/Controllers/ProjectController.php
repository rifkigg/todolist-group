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

        //render view with products
        return view('pages.project.project', compact('project'));
    }

    public function create(): View
    {
        return view('pages.project.addProject');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name'              => 'required|min:5',
            'category_id'       => 'required',
            'status_id'         => 'required',
            'live_date'         => 'required',
            'project_detail'    => 'required|min:5',
        ]);

        Project::create([
            'name'              => $request->name,
            'category_id'       => $request->category_id,
            'status_id'         => $request->status_id,
            'live_date'         => $request->live_date,
            'project_detail'    => $request->project_detail,
        ]);

         //redirect to index
         return redirect()->route('project.index')->with(['success' => 'Data Berhasil Disimpan!']);
}
}