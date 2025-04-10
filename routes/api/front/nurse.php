<?php

use App\Http\Controllers\Api\Front\NurseController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum, checkUserType:nurse')->prefix('nurse')->group(function () {
        Route::get('/patients', [NurseController::class, 'patients']);
        Route::get('/profile', [NurseController::class, 'profile']);
    });