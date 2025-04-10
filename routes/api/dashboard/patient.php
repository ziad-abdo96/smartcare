<?php

use App\Http\Controllers\Api\Dashboard\AdminPatientController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'checkUserType:admin'])->prefix('dashboard/patients')->group(function () {
    Route::get('/', [AdminPatientController::class, 'index']);
    Route::post('/', [AdminPatientController::class, 'store']);
    Route::get('/{id}', [AdminPatientController::class, 'show']);
    Route::put('/{id}', [AdminPatientController::class, 'update']);
    Route::delete('/{id}', [AdminPatientController::class, 'destroy']);
});