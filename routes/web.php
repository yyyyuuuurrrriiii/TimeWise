<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Route to view the Matrix page
experimental_feature_or_route: // (Just use standard route below)
Route::get('/matrix', [TaskController::class, 'index']);

// Route to save a new task
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::patch('/tasks/{id}/complete', [TaskController::class, 'toggleComplete'])->name('tasks.complete');