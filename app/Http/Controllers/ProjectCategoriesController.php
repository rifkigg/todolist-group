<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectCategories;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class ProjectCategoriesController extends Controller
{
    public function index():View
    {
        $categories = ProjectCategories::all();
        return view('pages.project.categoriesProject', compact('categories'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name'              => 'required',
            'slug'       => 'required'
        ]);

        ProjectCategories::create([
            'name'              => $request->name,
            'slug'       => $request->slug
        ]);

         //redirect to index
         return redirect()->route('projectcategories.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}