<?php

use App\Models\task;
use App\Models\User;
use App\Models\board;
use App\Models\project;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\LabelsController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OnGoingController;
use App\Http\Controllers\StatusTaskController;
use App\Http\Controllers\TaskChecklistController;
use App\Http\Controllers\TaskPrioritiesController;
use App\Http\Controllers\TaskDescriptionController;
use App\Http\Controllers\ProjectCategoriesController;
use App\Http\Controllers\UserController;
use App\Models\TaskChecklist;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/manage_user', [UserController::class, 'index'])->name('manage_user.index');
    Route::post('/manage_user/store', [UserController::class, 'store'])->name('manage_user.store');
    Route::put('/manage_user/update/{id}', [UserController::class, 'update'])->name('manage_user.update');
    Route::delete('/manage_user/destroy/{id}', [UserController::class, 'destroy'])->name('manage_user.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/dashboard', function () {
    //     return view('pages.dashboard');
    // });
    Route::get('/project', function () {
        return view('pages.project.project');
    });
    Route::get('/project/categories', function () {
        return view('pages.project.categoriesProject');
    });
    Route::get('/project/status', function () {
        return view('pages.project.statusProject');
    });

    Route::get('/task/status', function () {
        return view('pages.task.statusTask');
    });

    Route::get('/status', [StatusController::class, 'index'])->name('status.index');

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

    Route::get('/task', function () {
        return view('pages.task.task');
    });
    Route::get('/task/categories', function () {
        return view('pages.task.prioritiesTask');
    });
    Route::get('/task/status', function () {
        return view('pages.task.statustask');
    });
    Route::get('/task/label', function () {
        return view('pages.task.statustask')->name('labels.index');
    });

    Route::get('/task', [TaskController::class, 'index'])->name('task.index');
    Route::post('/task/create', [TaskController::class, 'store'])->name('task.store');
    Route::put('/task/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/task/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::post('/task/duplicate/{id}', [TaskController::class, 'duplicate'])->name('task.duplicate');
    Route::post('/task', [AttachmentController::class, 'store'])->name('attachments.store');
    Route::delete('/attachments/{task_id}/{file_name}', [AttachmentController::class, 'destroy'])->name('attachments.destroy');
    Route::post('/activity/store', [ActivityController::class, 'store'])->name('activity.store');
    Route::post('/checklist/store', [TaskChecklistController::class, 'store'])->name('checklist.store');

    Route::get('/status', [StatusController::class, 'index'])->name('status.index');
    Route::get('/task/status', [StatusTaskController::class, 'index'])->name('task_status.index');
    Route::post('/task/status', [StatusTaskController::class, 'store'])->name('task_status.store');
    Route::delete('/task/status/{id}', [StatusTaskController::class, 'destroy'])->name('task_status.destroy');
    Route::get('/task/status/{id}', [StatusTaskController::class, 'show'])->name('task_status.show');
    Route::put('/task/status/{id}', [StatusTaskController::class, 'update'])->name('task_status.update');

    Route::get('/task/priorities', [TaskPrioritiesController::class, 'index'])->name('priorities.index');
    Route::post('/task/priorities', [TaskPrioritiesController::class, 'store'])->name('priorities.store');
    Route::delete('/task/priorities/{id}', [TaskPrioritiesController::class, 'destroy'])->name('priorities.destroy');
    Route::get('/task/priorities/{id}', [TaskPrioritiesController::class, 'show'])->name('priorities.show');
    Route::put('/task/priorities/{id}', [TaskPrioritiesController::class, 'update'])->name('priorities.update');

    Route::get('/task/labels', [taskController::class, 'edit'])->name('labels.index');
    Route::post('/task/duplicate/{id}', [taskController::class, 'duplicate'])->name('task.duplicate');

    Route::get('/task/labels', [LabelsController::class, 'index'])->name('labels.index');
    Route::post('/task/labels', [LabelsController::class, 'store'])->name('labels.store');
    Route::delete('/task/labels/{id}', [LabelsController::class, 'destroy'])->name('labels.destroy');
    Route::get('/task/labels/{id}', [LabelsController::class, 'edit'])->name('labels.edit');
    Route::put('/task/labels/{id}', [LabelsController::class, 'update'])->name('labels.update');

    Route::get('/boards', [BoardController::class, 'index'])->name('boards.index');
    Route::post('/taskboards/create', [TaskController::class, 'storeToBoard'])->name('taskboards.store');
    Route::get('/boards/create', [BoardController::class, 'create'])->name('boards.create');
    Route::post('/boards/add', [BoardController::class, 'store'])->name('boards.store');
    Route::delete('/boards/{id}', [BoardController::class, 'destroy'])->name('boards.destroy');

    Route::post('/task/{id}/description', [TaskDescriptionController::class, 'store'])->name('description.store');
    Route::put('/description/{id}', [TaskDescriptionController::class, 'update'])->name('description.update');

    Route::post('/update/completed', [TaskChecklistController::class, 'updateCompleted'])->name('update.completed');
    Route::delete('/checklist/{id}', [TaskChecklistController::class, 'destroy'])->name('checklist.destroy');

    Route::get('/tasks/user/{userId}', [TaskController::class, 'getTasksByUser'])->name('tasks.byUser');

    Route::post('/history/start', [TaskController::class, 'start'])->name('history.start');
    Route::post('/history/pause', [TaskController::class, 'pause'])->name('history.pause');
    Route::post('/history/finish', [TaskController::class, 'finish'])->name('history.finish');
    Route::get('/history', [TaskController::class, 'indexTime'])->name('history.index');

    Route::get('/ongoing', [OnGoingController::class, 'index'])->name('ongoing.index');
});

require __DIR__ . '/auth.php';
