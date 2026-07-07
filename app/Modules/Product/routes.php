<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Product\Controllers\ProductController;
Route::prefix('products')->middleware(['web', 'auth:web'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('admin.products');
});
