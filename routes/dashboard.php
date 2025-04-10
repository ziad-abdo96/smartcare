<?php

use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\DepartmentController;
use App\Http\Controllers\dashboard\AdminDoctorController;
use App\Http\Controllers\dashboard\AdminNurseController;
use App\Http\Controllers\dashboard\AdminPatientController;
use App\Http\Controllers\dashboard\RoleController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth', 'checkUserType:admin']
], function () {
    
Route::resource('dashboard/admins', AdminController::class)->names('dashboard.admins');
Route::resource('dashboard/roles', RoleController::class)->names('dashboard.roles');
Route::resource('dashboard/doctors', AdminDoctorController::class)->names('dashboard.doctors');
Route::resource('dashboard/nurses', AdminNurseController::class)->names('dashboard.nurses');
Route::resource('dashboard/patients', AdminPatientController::class)->names('dashboard.patients');
Route::resource('dashboard/departments', DepartmentController::class)->names('dashboard.departments');
});