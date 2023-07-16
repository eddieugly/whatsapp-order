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
use App\Http\Controllers\Admin\BlogcategoryController as AdminBlogcategoryController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\DeleteImageController as AdminDeleteImageController;
use App\Http\Controllers\Admin\DetachPermissionFromRoleController as AdminDetachPermissionFromRoleController;
use App\Http\Controllers\Admin\GeneralController as AdminGeneralController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\UploadImagesController as AdminUploadImagesController;

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
    return Inertia::render('Frontend/Home', [
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

        Route::post('upload-images', AdminUploadImagesController::class)->name('images.store');

        Route::post('delete-images', AdminDeleteImageController::class)->name('images.destroy');

        Route::resource('blog-category', AdminBlogcategoryController::class);

        Route::resource('blogs', AdminBlogController::class);

        Route::get('general-settings', [AdminGeneralController::class, 'general'])->name('settings.index');

        Route::post('general-settings', [AdminGeneralController::class, 'updateGeneral'])->name('settings.update');

        Route::post('general-settings-logo', [AdminGeneralController::class, 'logoUpdate'])->name('settings.update.logo');
        
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
