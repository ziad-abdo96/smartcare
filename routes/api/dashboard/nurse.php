<?php

use App\Http\Controllers\Api\Dashboard\AdminNurseController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'checkUserType:admin'])->prefix('dashboard/nurses')->group(function () {
    Route::get('/', [AdminNurseController::class, 'index']);
    Route::post('/', [AdminNurseController::class, 'store']);
    Route::get('/{id}', [AdminNurseController::class, 'show']);
    Route::put('/{id}', [AdminNurseController::class, 'update']);
    Route::delete('/{id}', [AdminNurseController::class, 'destroy']);
});
