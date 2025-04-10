<?php
use App\Http\Controllers\Api\Front\DiagnosisController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('patient')->group(function () {
    Route::get('{patientId}/diagnoses', [DiagnosisController::class, 'index'])->middleware('checkUserType:doctor,nurse');
    Route::post('{patientId}/diagnoses', [DiagnosisController::class, 'store'])->middleware('checkUserType:doctor');
});
