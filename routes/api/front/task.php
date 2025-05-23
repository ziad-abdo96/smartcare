<?php

use App\Http\Controllers\Api\Front\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('tasks')->group(function () {
    Route::get('/patient/{id}', [TaskController::class, 'show'])->name('tasks.index')->middleware('checkUserType:doctor,nurse');
    Route::post('/', [TaskController::class, 'store'])->middleware('checkUserType:doctor');
    Route::post('/{id}', [TaskController::class, 'update'])->middleware('checkUserType:nurse');
    Route::get('/{id}', [TaskController::class, 'destroy'])->middleware('checkUserType:doctor');
});
