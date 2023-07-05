<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PermissionsController as AdminPermissionsController;
use App\Http\Controllers\Admin\AttachPermissionToRoleController as AdminAttachPermissionToRoleController;
use App\Http\Controllers\Admin\DetachPermissionFromRoleController as AdminDetachPermissionFromRoleController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('TestPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Admin/Mydashboard');
        })->name('dashboard');

        
        Route::resource('roles', AdminRoleController::class);

        Route::post('roles/attach-permission', AdminAttachPermissionToRoleController::class)->name('roles.attach-permission');

        Route::post('roles/detach-permission', AdminDetachPermissionFromRoleController::class)->name('roles.detach-permission');

        Route::resource('category', AdminCategoryController::class);

        Route::resource('permissions', AdminPermissionsController::class);

        Route::resource('users', AdminUserController::class);

        Route::resource('menu', AdminMenuController::class);
        
    });
    
});

Route::get('/dashboard', function () {
    return Inertia::render('Admin/Mydashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('category', CategoryController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
