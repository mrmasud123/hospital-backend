<?php

use App\Modules\Department\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('departments')->middleware(['web', 'auth:web'])->group(function () {
    // routes here
    Route::get('/data', [DepartmentController::class, 'data'])->name('admin.departments.data');
    Route::get('/', [DepartmentController::class, 'index'])->name('admin.departments');
    Route::get('/create', [DepartmentController::class, 'create'])->name('admin.departments.create');
    Route::post('/store', [DepartmentController::class, 'store'])->name('admin.departments.store');
    Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('admin.departments.edit');
    Route::put('/{department}', [DepartmentController::class, 'update'])->name('admin.departments.update');;
});
