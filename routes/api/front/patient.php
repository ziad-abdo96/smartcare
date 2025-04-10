<?php

use App\Http\Controllers\Api\Front\PatientController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum, checkUserType:doctor')->prefix('patient')->group(function () {
    Route::get('/{id}', [PatientController::class, 'index']);
});
