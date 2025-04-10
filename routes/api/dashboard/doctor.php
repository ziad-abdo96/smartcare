<?php

use App\Http\Controllers\Api\Dashboard\AdminDoctorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum','checkUserType:admin'])->prefix('dashboard/doctors')->group(function () {
    Route::get('/', [AdminDoctorController::class, 'index']);
    Route::post('/', [AdminDoctorController::class, 'store']);
    Route::get('/{id}', [AdminDoctorController::class, 'show']);
    Route::put('/{id}', [AdminDoctorController::class, 'update']);
    Route::delete('/{id}', [AdminDoctorController::class, 'destroy']);
});