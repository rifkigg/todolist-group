<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProjectCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class ProjectCategoriesController extends Controller
{
    public function index(Request $request):View
    {
        if (now()->hour === 17) { //jam 5 sore menurut UTC jika di jakarta itu jam 12 malam
            // Tambahkan refresh halaman satu kali sebelum logout
            echo "<script>if (!sessionStorage.getItem('reloaded')) { sessionStorage.setItem('reloaded', 'true'); location.reload(); }</script>";
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
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