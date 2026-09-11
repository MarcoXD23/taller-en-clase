<?php

use App\Http\Controllers\Api\V1\TareaController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->middleware('api')
    ->name('api.v1.')
    ->group(function (): void {
        Route::apiResource('tasks', TaskController::class)
            ->where(['task' => '[0-9]+'])
            ->only(['index', 'show']);

        Route::middleware('throttle:10,1')->group(function (): void {
            Route::apiResource('tasks', TaskController::class)
                ->where(['task' => '[0-9]+'])
                ->except(['index', 'show']);
        });

        Route::apiResource('tareas', TareaController::class)
            ->whereNumber('tarea');
    });
