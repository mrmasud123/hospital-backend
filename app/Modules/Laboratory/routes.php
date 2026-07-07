<?php

use App\Modules\Laboratory\Controllers\LaboratoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('laboratories')->middleware(['web', 'auth:web'])->group(function () {
    // routes here

    Route::get('/', [LaboratoryController::class, 'index'])->name('laboratory.index');
});
