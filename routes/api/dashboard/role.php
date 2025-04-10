<?php

use App\Http\Controllers\Api\Dashboard\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'checkUserType:admin'])->prefix('dashboard/roles')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::post('/', [RoleController::class, 'store']);
    Route::get('/{id}', [RoleController::class, 'show']);
    Route::put('/{id}', [RoleController::class, 'update']);
    Route::delete('/{id}', [RoleController::class, 'destroy']);
});