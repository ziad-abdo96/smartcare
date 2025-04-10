<?php

use App\Http\Controllers\Api\Front\DoctorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'checkUserType:doctor'])->prefix('doctor')->group(function () {
    Route::get('/patients', [DoctorController::class, 'patients']);
    Route::get('/profile', [DoctorController::class, 'profile']);
});
