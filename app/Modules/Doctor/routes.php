<?php

use App\Modules\Doctor\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;

Route::prefix('doctors')->middleware(['web', 'auth:web'])->group(function () {
//    Route::get('/', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/', [DoctorController::class, 'index'])->name('admin.doctors.manage');
    Route::get('/data', [DoctorController::class, 'data'])->name('admin.doctors.data');

    Route::get('/create', [DoctorController::class, 'create'])->name('admin.doctors.create');
    Route::post('/store', [DoctorController::class, 'store'])->name('admin.doctors.store');
    Route::get('/{user}/edit', [DoctorController::class, 'edit'])->name('admin.doctors.edit');
    Route::put('/{doctor}', [DoctorController::class, 'update'])->name('admin.doctors.update');

    // Delete doctor
    Route::delete('/{doctor}', [DoctorController::class, 'destroy'])->name('destroy');

});
