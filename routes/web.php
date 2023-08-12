<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\HomeControler;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\GeneralController as AdminGeneralController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DeleteImageController as AdminDeleteImageController;
use App\Http\Controllers\Admin\PermissionsController as AdminPermissionsController;
use App\Http\Controllers\Admin\BlogcategoryController as AdminBlogcategoryController;
use App\Http\Controllers\Admin\UploadImagesController as AdminUploadImagesController;
use App\Http\Controllers\Admin\AttachPermissionToRoleController as AdminAttachPermissionToRoleController;
use App\Http\Controllers\Admin\DetachPermissionFromRoleController as AdminDetachPermissionFromRoleController;
use App\Http\Controllers\PaymentController;

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


Route::get('/', [HomeControler::class, 'index'])->name('home');

Route::get('/category/{category:slug}', [CategoryController::class, 'index'])->name('frontend.category.index');

Route::get('/categories', [CategoryController::class, 'general'])->name('frontend.categories');

Route::get('/menus', [MenuController::class, 'general'])->name('frontend.menus');

Route::get('/menu/{menu:slug}', [MenuController::class, 'index'])->name('frontend.menu.index');

Route::get('/cart', [CartController::class, 'index'])->name('frontend.cart.index');

Route::get('/checkout', [OrderController::class, 'checkout'])->name('frontend.checkout.index');

Route::post('/checkout/store', [OrderController::class, 'store'])->name('frontend.checkout.store');

Route::get('/order-confirmation/{order}', [OrderController::class, 'confirmation'])->name('frontend.order.confirmation');

Route::get('/faq', [CartController::class, 'faq'])->name('frontend.faq');

Route::get('/contact', [CartController::class, 'contact'])->name('frontend.contact.index');

Route::post('/contact', [CartController::class, 'contactStore'])->name('frontend.contact.store');

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
