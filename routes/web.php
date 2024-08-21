<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\project_categories;
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

Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');
Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');