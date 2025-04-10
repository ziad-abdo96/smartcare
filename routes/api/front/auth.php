<?php

use App\Http\Controllers\Api\AccessTokensController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('access-token', [AccessTokensController::class, 'store'])
        ->middleware('guest:sanctum');
    Route::delete('access-token/{token?}', [AccessTokensController::class, 'destroy'])
        ->middleware('auth:sanctum');
    Route::delete('access-tokens', [AccessTokensController::class, 'destroyAllToken'])
        ->middleware('auth:sanctum');
});
