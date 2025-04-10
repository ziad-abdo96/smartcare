<?php

use App\Http\Controllers\Api\Front\LabTestController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('lab-tests')->group(function () {
    Route::get('/patient/{id}', [LabTestController::class, 'show'])->middleware('checkUserType:doctor, nurse');
    Route::post('/', [LabTestController::class, 'store'])->middleware('checkUserType:doctor');
    Route::put('/{id}', [LabTestController::class, 'update'])->middleware('checkUserType:nurse');
    Route::delete('/{id}', [LabTestController::class, 'destroy'])->middleware('checkUserType:doctor');
});