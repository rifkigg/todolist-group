<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/table', function () {
    return view('table');
});
Route::get('/base', function () {
    return view('pages.project');
});
