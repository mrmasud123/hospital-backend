<?php

use App\Modules\Prescription\Controllers\PrescriptionController;
use Illuminate\Support\Facades\Route;

Route::prefix('prescriptions')->middleware(['web', 'auth:web'])->group(function () {
    // routes here

    Route::get('/', [PrescriptionController::class, 'index'])->name('prescription.index');
});
