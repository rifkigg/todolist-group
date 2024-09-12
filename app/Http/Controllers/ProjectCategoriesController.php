<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectCategories;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;


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
            'slug'
        ]);

        // Generate slug secara otomatis dari input name
        $slug = Str::slug($request->input('name'), '-');

        // menyim data
        ProjectCategories::create([
            'name'              => $request->name,
            'slug'
        ]);

         //redirect to index
         return redirect()->route('projectcategories.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy($id) 
    {
        $category = ProjectCategories::findOrFail($id);
        
        $category->delete();
    
        return redirect()->route('projectcategories.index')->with('success', 'Kategori berhasil dihapus.');
    }

    public function show(string $id): View
    {
        $category = ProjectCategories::findOrFail($id);
        return view('pages.project.editCategoriesProject', compact('category')); 
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

        //get product by ID
        $category = ProjectCategories::findOrFail($id);

        //update product without image
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        //redirect to index
        return redirect()
            ->route('projectcategories.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }
}