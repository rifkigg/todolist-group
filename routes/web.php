<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.dashboard');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard');
});
// Route::get('/project', function () {
//     return view('pages.project.project');
// });
Route::get('/project/add', function () {
    return view('pages.project.addProject');
})->name('project.add');
Route::get('/project/categories', function () {
    return view('pages.project.categoriesProject');
});
Route::get('/project/status', function () {
    return view('pages.project.statusProject');
});

Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
