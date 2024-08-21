<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.dashboard');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard');
});
Route::get('/project', function () {
    return view('pages.project.project');
});
Route::get('/project/add', function () {
    return view('pages.project.addProject');
})->name('project.add');
Route::get('/project/categories', function () {
    return view('pages.project.categoriesProject');
});
Route::get('/project/status', function () {
    return view('pages.project.statusProject');
});

<<<<<<< HEAD
// Route::get('/project', ProjectController::class, 'index');
=======
Route::get('/project', [ProjectController::class, 'index']);
>>>>>>> b7103ef9b4dc450e4ec15c30e9cffd5681ff7c0b
