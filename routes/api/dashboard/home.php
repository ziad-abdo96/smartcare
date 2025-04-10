<?php

use App\Http\Controllers\API\Dashboard\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'checkUserType:admin'])->prefix('dashboard/home')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
});
