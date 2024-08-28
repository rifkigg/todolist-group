<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use Illuminate\View\View;
use App\Models\ProjectStatus;
use App\Models\ProjectCategories;
use App\Http\Controllers\Controller;
use App\Models\task;
use Illuminate\Http\RedirectResponse;

class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::all();
        $projects = Project::all();
        $total_user = User::count();
        $task = task::all();
        $total_board = Board::count();

        return view('pages.boards', compact('boards', 'projects')); // Pass boards and projects to the view
    }

    public function destroy($id) {
        $boards = Board::findOrFail($id);
        $boards->delete();
        return redirect()->route('boards.index')->with('success', 'Board deleted successfully.');
    }
}