<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\project;
use App\Models\User;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index() 
    {
        $task = task::all();
        $total_project = Project::count();
        $total_user = User::count();
        return view('pages.task.task', compact('task', 'total_project', 'total_user'));
    }
}
