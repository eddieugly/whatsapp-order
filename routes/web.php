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
