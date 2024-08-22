<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectCategoriesController;
use App\Http\Controllers\StatusController;
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
Route::get('/project/categories', function () {
    return view('pages.project.categoriesProject');
});
Route::get('/project/status', function () {
    return view('pages.project.statusProject');
});

Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
Route::post('/project/add', [ProjectController::class, 'store'])->name('project.store');
Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');
Route::get('/project/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
Route::put('/project/edit/{id}', [ProjectController::class, 'update'])->name('project.update');
Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
Route::post('/project/duplicate/{id}', [ProjectController::class, 'duplicate'])->name('project.duplicate');

Route::get('/project/status', [StatusController::class, 'index'])->name('project_status.index');
Route::post('/project/status', [StatusController::class, 'store'])->name('project_status.store');
Route::delete('/project/status/{id}', [StatusController::class, 'destroy'])->name('project_status.destroy');
Route::get('/project/status/{id}', [StatusController::class, 'edit'])->name('project_status.edit');
Route::put('/project/status/{id}', [StatusController::class, 'update'])->name('project_status.update');

Route::get('/project/categories', [ProjectCategoriesController::class, 'index'])->name('projectcategories.index');
Route::post('/project/categories', [ProjectCategoriesController::class, 'store'])->name('projectcategories.store');
Route::delete('/project/categories/{id}', [ProjectCategoriesController::class, 'destroy'])->name('projectcategories.destroy');
Route::get('/project/categories/{id}', [ProjectCategoriesController::class, 'show'])->name('projectcategories.show');
Route::put('/project/categories/{id}', [ProjectCategoriesController::class, 'update'])->name('projectcategories.update');
