<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/tasks',TasksController::class);

Route::get('/tasks/deadline/{deadline}', [TasksController::class, 'getTaskByDeadline']);

Route::get('/tasks/status/{status}', [TasksController::class, 'getByStatus']);

