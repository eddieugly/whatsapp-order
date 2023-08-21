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
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DetachPermissionFromRoleController as AdminDetachPermissionFromRoleController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
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

// Home Route
Route::get('/', [HomeControler::class, 'index'])->name('home');


// Frontend Routes
Route::name('frontend.')->group(function () {

    Route::get('/category/{category:slug}', [CategoryController::class, 'index'])->name('category.index');

    Route::get('/categories', [CategoryController::class, 'general'])->name('categories');

    Route::get('/menus', [MenuController::class, 'general'])->name('menus');

    Route::get('/menu/{menu:slug}', [MenuController::class, 'index'])->name('menu.index');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout.index');

    Route::post('/checkout/store', [OrderController::class, 'store'])->name('checkout.store');

    Route::get('/order-confirmation/{order}', [OrderController::class, 'confirmation'])->name('order.confirmation');

    Route::get('/faq', [CartController::class, 'faq'])->name('faq');

    Route::get('/contact', [CartController::class, 'contact'])->name('contact.index');

    Route::post('/contact', [CartController::class, 'contactStore'])->name('contact.store');

});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');


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

        Route::resource('orders', AdminOrderController::class);
    });
});

Route::prefix('user')->name('user.')->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        
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

require __DIR__ . '/auth.php';
