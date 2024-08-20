<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard');
});
Route::get('/project', function () {
    return view('pages.project.project');
});
Route::get('/project/add', function () {
    return view('pages.project.addProject');
});
Route::get('/project/categories', function () {
    return view('pages.project.categoriesProject');
});
Route::get('/project/status', function () {
    return view('pages.project.statusProject');
});
