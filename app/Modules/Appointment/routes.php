<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Appointment\Controllers\AppointmentController;
Route::prefix('appointment')->middleware(['web', 'auth:web'])->group(function () {

    Route::get('/', [AppointmentController::class, 'index'])->name('admin.appointment.index');
    Route::get('/data', [AppointmentController::class, 'data'])->name('admin.appointment.data');
    Route::get('/create', [AppointmentController::class, 'create'])->name('admin.appointments.create');
    Route::get('/edit/{appointment}', [AppointmentController::class, 'edit'])->name('admin.appointments.edit');
});
