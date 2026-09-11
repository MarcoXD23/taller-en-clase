<?php

use App\Http\Controllers\Api\V1\TareaController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
	->middleware('api')
	->name('api.v1.')
	->group(function (): void {
		Route::apiResource('tareas', TareaController::class)
			->whereNumber('tarea');
	});
