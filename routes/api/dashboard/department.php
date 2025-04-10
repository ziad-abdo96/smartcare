<?php

use App\Http\Controllers\Api\Dashboard\DepartmentController;

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum, checkUserType:admin')->prefix('dashboard/departments')->group(function () {
    Route::get('/', [DepartmentController::class, 'index']);
    Route::post('/', [DepartmentController::class, 'store']);
    Route::get('/{id}', [DepartmentController::class, 'show']);
    Route::put('/{id}', [DepartmentController::class, 'update']);
    Route::delete('/{id}', [DepartmentController::class, 'destroy']);
});