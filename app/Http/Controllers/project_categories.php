<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class project_categories extends Controller
{

    public function index()
    {
        $categories = project_categories::all();
        return view('pages.project.categoriesProject', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate and create a new project category
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:project_categories',
        ]);
        return project_categories::create($request->all());
    }

    public function create()
    {
        return view('project_categories.form');
    }

    public function show($id)
    {
        // Retrieve a specific project category by ID
        return project_categories::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        // Validate and update the specified project category
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:project_categories,slug,' . $id,
        ]);
        $category = project_categories::findOrFail($id);
        $category->update($request->all());
        return $category;
    }


    public function edit($id)
    {
        $category = project_categories::findOrFail($id);
        return view('project_categories.form', compact('category'));
    }

    public function destroy($id)
    {
        // Delete the specified project category
        $category = project_categories::findOrFail($id);
        $category->delete();
        return response()->noContent();
    }
}