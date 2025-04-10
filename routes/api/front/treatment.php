<?php

use App\Http\Controllers\Api\Front\TreatmentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('treatments')->group(function () {
    Route::get('/patient/{id}', [TreatmentController::class, 'show'])->middleware('checkUserType:doctor, nurse');
    Route::post('/', [TreatmentController::class, 'store'])->middleware('checkUserType:doctor');
    Route::put('/{id}', [TreatmentController::class, 'update'])->middleware('checkUserType:nurse');
    Route::delete('/{id}', [TreatmentController::class, 'destroy'])->middleware('checkUserType:doctor');
});