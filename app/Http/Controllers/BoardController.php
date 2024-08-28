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

        return view('pages.boards', compact('boards', 'projects')); 
    }

    public function create(): View 
    {
        $projects = Project::all();
        return view('pages.create_board', compact('boards')); 
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'board_name' => 'required',
            'project_id' => 'required',
        ]);

        Board::create([
            'board_name' => $request->board_name,
            'project_id' => $request->project_id,
        ]);

        return redirect()
            ->route('boards.index')
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function destroy($id) {
        $boards = Board::findOrFail($id);
        $boards->delete();
        return redirect()->route('boards.index')->with('success', 'Board deleted successfully.');
    }
}