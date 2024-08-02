<?php

use App\Http\Controllers\EstudianteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::get('/estudiantes', [EstudianteController::class, 'index']);

Route::get('/estudiantes/{id}', [EstudianteController::class, 'show']);

Route::post('/estudiantes', [EstudianteController::class, 'store']);

Route::put('/estudiantes/{id}', [EstudianteController::class, 'update']);

Route::patch('/estudiantes/{id}', [EstudianteController::class, 'updatePartial']);

Route::delete('/estudiantes/{id}', [EstudianteController::class, 'delete']);