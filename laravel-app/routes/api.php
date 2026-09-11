<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\Api\V1\TareaController;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/{id}', [TaskController::class, 'show']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

Route::prefix('v1')
	->middleware('api')
	->name('api.v1.')
	->group(function (): void {
		Route::apiResource('tareas', TareaController::class)
			->whereNumber('tarea');
	});
