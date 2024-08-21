<?php

namespace App\Http\Controllers;

use App\Models\project_status;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class StatusController extends Controller
{


    public function index()
    {
        // Logika untuk menampilkan status
        return view('pages.project.statusProject');
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name'         => 'required|min:5',
        ]);

        //create product
        project_status::create([
            'name'         => $request->name,
        ]);

        return redirect()->route('project_status.index')->with(['success' => 'Data Berhasil Disimpan!']);

}
}