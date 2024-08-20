<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class project_categories extends Controller
{

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name'         => 'required|min:5',
            'slug'         => 'required|min:5'
        ]);

        //create product
        Product::create([
            'name'         => $request->name,
            'slug'         => $request->slug
        ]);

}
}