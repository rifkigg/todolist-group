<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\project_categories;
use Illuminate\View\View;


class ProjectCategoriesController extends Controller
{
    public function index():View
    {
        $categories = project_categories::all();
        return view('pages.project.categoriesProject', compact('categories'));
    }

    public function create(): View
    {
        
    }

    public function show(string $id): View
    {
        
    }

    public function destroy($id): RedirectResponse
    {
        
    }
    
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name'              => 'required|min:5',
            'slug'       => 'required|min:10'
        ]);

        Project::create([
            'name'              => $request->name,
            'slug'       => $request->slug
        ]);

         //redirect to index
         return redirect()->route('project.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}