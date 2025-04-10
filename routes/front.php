<?php

use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\Front\DoctorController;
use App\Http\Controllers\Front\NurseController;
use App\Http\Controllers\Front\PatientController;
use App\Http\Controllers\LabTestController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('patient')->group(function () {
    Route::get('{id}/tasks', [PatientController::class, 'showTasks'])->name('patient.tasks')->middleware('checkUserType:doctor,nurse');
    Route::get('{id}/info', [PatientController::class, 'showInfo'])->name('patient.info')->middleware('checkUserType:doctor,nurse');
    Route::get('{id}/tests', [PatientController::class, 'showTests'])->name('patient.tests')->middleware('checkUserType:doctor,nurse');

    // Route::resource('{id}/treatments', TreatmentController::class)->except('show')->middleware('checkUserType:doctor,nurse');

    Route::get('treatments/{id}', [TreatmentController::class, 'index'])->name('treatments.index')->middleware('checkUserType:doctor,nurse');
    Route::post('/treatments', [TreatmentController::class, 'store'])->name('treatments.store')->middleware('checkUserType:doctor');
    Route::put('/treatments/{id}', [TreatmentController::class, 'update'])->name('treatments.update')->middleware('checkUserType:nurse');
    Route::delete('/treatments/{id}', [TreatmentController::class, 'destroy'])->name('treatments.destroy')->middleware('checkUserType:doctor');

    Route::get('/rays/{id}', [TaskController::class, 'index'])->name('tasks.index')->middleware('checkUserType:doctor,nurse');
    Route::post('/rays', [TaskController::class, 'store'])->name('tasks.store')->middleware('checkUserType:doctor');
    Route::put('/rays/{id}', [TaskController::class, 'update'])->name('tasks.update')->middleware('checkUserType:nurse');
    Route::delete('/rays/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy')->middleware('checkUserType:doctor');

    Route::get('/lab-tests/{id}', [LabTestController::class, 'index'])->name('lab-tests.index')->middleware('checkUserType:doctor,nurse');
    Route::post('/lab-tests/store', [LabTestController::class, 'store'])->name('lab-tests.store')->middleware('checkUserType:doctor');
    Route::delete('/lab-tests/{id}', [LabTestController::class, 'destroy'])->name('lab-tests.destroy')->middleware('checkUserType:doctor');
    Route::put('/lab-tests/{id}', [LabTestController::class, 'update'])->name('lab-tests.update')->middleware('checkUserType:doctor,nurse');

    Route::get('/patients/{patient}/diagnoses', [DiagnosisController::class, 'index'])->name('diagnoses.index')->middleware('checkUserType:doctor,nurse');
    Route::post('/patients/{patient}/diagnoses', [DiagnosisController::class, 'store'])->name('diagnoses.store')->middleware('checkUserType:doctor');
    ;

});

Route::middleware(['auth'])->group(function () {
    Route::get('doctor/patients', [DoctorController::class, 'patients'])->name('doctor.patients')->middleware('checkUserType:doctor');
    Route::get('doctor/profile', [DoctorController::class, 'profile'])->name('doctor.profile')->middleware('checkUserType:doctor');
    Route::get('nurse/patients', [NurseController::class, 'patients'])->name('nurse.patients')->middleware('checkUserType:nurse');
    Route::get('nurse/profile', [NurseController::class, 'profile'])->name('nurse.profile')->middleware('checkUserType:nurse');
    Route::get('patient/{id}/show', [PatientController::class, 'show'])->name('patient.show')->middleware('checkUserType:doctor,nurse');
});


Route::middleware(['auth', 'checkUserType:doctor,nurse'])->prefix('patients')->group(function () {
    Route::get('/', [PatientController::class, 'index'])->name('patient.index');
    Route::get('/create', [PatientController::class, 'create'])->name('patient.create');
    Route::post('/', [PatientController::class, 'store'])->name('patient.store');
    Route::get('/{id}/edit', [PatientController::class, 'edit'])->name('patient.edit'); 
    Route::put('/{id}', [PatientController::class, 'update'])->name('patient.update'); 
    Route::delete('/{id}', [PatientController::class, 'destroy'])->name('patient.destroy');
});

// Route::get('/treatments/{id}', [TreatmentController::class, 'index'])->name('treatments.index')->middleware('checkUserType:doctor,nurse');
// Route::post('/treatments/store', [TreatmentController::class, 'store'])->name('treatments.store')->middleware('checkUserType:doctor');
// Route::delete('/treatments/{id}', [TreatmentController::class, 'destroy'])->name('treatments.destroy')->middleware('checkUserType:doctor');
// Route::put('/treatments/{id}', [TreatmentController::class, 'update'])->name('treatments.update')->middleware('checkUserType:doctor,nurse');
