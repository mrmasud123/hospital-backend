<?php

use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\AuthController;


//Route::prefix('user')->group(function(){

    Route::post('/login', [UserAUthController::class, 'login'])->name('user.login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [UserAUthController::class, 'logout'])->name('user.logout');
        Route::get('/me', [UserAUthController::class, 'me'])->name('me');

        Route::get('doctors', [AppointmentController::class, 'doctors']);

        Route::get('appointments', [AppointmentController::class, 'index']);
        Route::post('appointments', [AppointmentController::class, 'store']);
        Route::patch('appointments/{appointment}/cancel', [AppointmentController::class, 'cancel']);
    });
//});
