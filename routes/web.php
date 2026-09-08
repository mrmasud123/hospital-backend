<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PermisssionController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\SsoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\MappingController;


Route::middleware(['auth'])
->get('/modules/pharmacy/launch', [SsoController::class, 'launchPharmacy'])
    ->name('sso.pharmacy.launch');

Route::get('/sso/silent-check', [SsoController::class, 'silentCheck'])
    ->name('sso.silent-check');
//Authentication
Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/auth/google/redirect', [AuthController::class, 'googleRedirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback'])->name('auth.google.callback');
// dashboard pages
Route::middleware('auth:web')->group(function () {
    Route::get('/online-users', [AdminController::class, 'onlineUsers'])->name('admin.online-users');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', function () {
        return view('pages.dashboard.ecommerce');
    })->name('dashboard');

    Route::get('/roles', [RolesController::class, 'index'])->name('admin.roles');
    Route::get('/roles/create', [RolesController::class, 'create'])->name('admin.roles.create');
    Route::post('/roles', [RolesController::class, 'store'])->name('admin.roles.store');
    Route::get('/roles/{role}/permissions', [RolesController::class, 'show'])->name('admin.add.permissions.to.role');
    Route::put('/roles/{role}/permissions', [RolesController::class, 'assignPermission'])->name('admin.roles.update-permissions');
    Route::get('/admin/roles/data', [RolesController::class, 'data'])->name('admin.roles.data');
//    Route::prefix('notifications')->name('notifications.')->group(function () {
//        Route::get('/',              [NotificationController::class, 'index'])->name('index');
//        Route::post('/{id}/read',    [NotificationController::class, 'markAsRead'])->name('read');
//        Route::post('/read-all',     [NotificationController::class, 'markAllAsRead'])->name('readAll');
//    });
    Route::get('/test/all-roles', [RolesController::class, 'allRoles'])->name('test.all.roles');
    Route::get('/role-permission-mapping', [MappingController::class, 'rolePermissionMapping'])
        ->name('role.permission.mapping');

    Route::post('/role-permission-mapping/store',
        [MappingController::class, 'storeMapping']
    )->name('role.permission.mapping.store');

    Route::get('/users/with/roles/permissions/data', [MappingController::class, 'userWithRolesPermissionData'])->name('admin.customers.with.roles.permissions.data');
    Route::get('/role-permission-mapping/map/{user}', [MappingController::class, 'assignEmployeeRole'])
        ->name('admin.assign.role');

    Route::get('/permissions', [PermisssionController::class, 'index'])->name('admin.permissions');
    Route::get('/permissions/create', [PermisssionController::class, 'create'])->name('admin.permissions.create');
    Route::post('/permissions', [PermisssionController::class, 'store'])->name('admin.permissions.store');

});


// calender pages
Route::get('/calendar', function () {
    return view('pages.calender', ['title' => 'Calendar']);
})->name('calendar');


// form pages
Route::get('/form-elements', function () {
    return view('pages.form.form-elements', ['title' => 'Form Elements']);
})->name('form-elements');

// tables pages
Route::get('/basic-tables', function () {
    return view('pages.tables.basic-tables', ['title' => 'Basic Tables']);
})->name('basic-tables');

// pages

Route::get('/blank', function () {
    return view('pages.blank', ['title' => 'Blank']);
})->name('blank');

// error pages
Route::get('/error-404', function () {
    return view('pages.errors.error-404', ['title' => 'Error 404']);
})->name('error-404');

// chart pages
Route::get('/line-chart', function () {
    return view('pages.chart.line-chart', ['title' => 'Line Chart']);
})->name('line-chart');

Route::get('/bar-chart', function () {
    return view('pages.chart.bar-chart', ['title' => 'Bar Chart']);
})->name('bar-chart');


// authentication pages


Route::get('/signup', function () {
    return view('pages.auth.signup', ['title' => 'Sign Up']);
})->name('signup');

// ui elements pages
Route::get('/alerts', function () {
    return view('pages.ui-elements.alerts', ['title' => 'Alerts']);
})->name('alerts');

Route::get('/avatars', function () {
    return view('pages.ui-elements.avatars', ['title' => 'Avatars']);
})->name('avatars');

Route::get('/badge', function () {
    return view('pages.ui-elements.badges', ['title' => 'Badges']);
})->name('badges');

Route::get('/buttons', function () {
    return view('pages.ui-elements.buttons', ['title' => 'Buttons']);
})->name('buttons');

Route::get('/image', function () {
    return view('pages.ui-elements.images', ['title' => 'Images']);
})->name('images');

Route::get('/videos', function () {
    return view('pages.ui-elements.videos', ['title' => 'Videos']);
})->name('videos');






















