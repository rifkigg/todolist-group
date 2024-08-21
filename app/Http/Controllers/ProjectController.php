<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function index()
    {
        //get all products
        $products = Project::latest()->paginate(10);

        //render view with products
        return view('pages.project', compact('project'));
    }

    public function create(): View
    {
        return view('pages.addProject');
    }
}
