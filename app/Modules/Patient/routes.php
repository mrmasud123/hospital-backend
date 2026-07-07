<?php

use App\Modules\Patient\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::prefix('patients')->middleware(['web', 'auth:web'])->group(function () {
    // routes here

    Route::get('/', [PatientController::class, 'index'])->name('patient.index');
});
