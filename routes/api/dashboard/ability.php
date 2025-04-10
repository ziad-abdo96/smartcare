<?php

use App\Http\Controllers\Api\Dashboard\AbilityController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard/abilities', [AbilityController::class, 'index'])
    ->middleware('auth:sanctum, checkUserType:admin');
