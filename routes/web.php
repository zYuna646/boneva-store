<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\accountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\MainSliderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymenController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\ReviewSliderController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontPageController::class, 'index'])->name('home');
Route::get('/catalog', [FrontPageController::class, 'catalog'])->name('catalog');
Route::get('/catalog/product/{slug}', [FrontPageController::class, 'productDetail'])->name('product.detail');

/* Authentication Routes... */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/register', [registerController::class, 'index'])->name('register');
Route::post('/register/create', [registerController::class, 'store'])->name('register.store');

Route::post('/catalog/order/{id}', [OrderController::class, 'order'])->name('catalog.order');
Route::get('/cart', [OrderController::class, 'cart'])->name('cart');
Route::put('/cart/add/{id}', [OrderController::class, 'add'])->name('cart.add');
Route::get('/cart/history', [OrderController::class, 'history'])->name('cart.history');

Route::put('/cart/minus/{id}', [OrderController::class, 'minus'])->name('cart.minus');
Route::post('/cart/confirmation/{id}', [OrderController::class, 'confirmation'])->name('cart.cofirmation');







Auth::routes([
    'register' => false, // Register Routes...
    'reset' => false, // Reset Password Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::middleware(['auth', 'login-check'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/admin/category/add', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/admin/category/{id}/update', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/admin/category/{id}/delete', [CategoryController::class, 'destroy'])->name('admin.category.delete');

    Route::get('/admin/account', [accountController::class, 'index'])->name('admin.account');
    Route::get('/admin/account/add', [accountController::class, 'create'])->name('admin.account.create');
    Route::post('/admin/account/store', [accountController::class, 'store'])->name('admin.account.store');
    Route::put('/admin/account/{id}/verified', [accountController::class, 'verified'])->name('admin.account.verified');
    Route::get('/admin/account/{id}/show', [accountController::class, 'show'])->name('admin.account.show');
    Route::get('/admin/account/{id}/edit', [accountController::class, 'edit'])->name('admin.account.edit');
    Route::put('/admin/account/{id}/update', [accountController::class, 'update'])->name('admin.account.update');
    Route::delete('/admin/account/{id}/delete', [accountController::class, 'destroy'])->name('admin.account.delete');


    Route::get('/admin/catalog', [CatalogController::class, 'index'])->name('admin.catalog');
    Route::get('/admin/catalog/add', [CatalogController::class, 'create'])->name('admin.catalog.create');
    Route::post('/admin/catalog/store', [CatalogController::class, 'store'])->name('admin.catalog.store');
    Route::get('/admin/catalog/{id}/show', [CatalogController::class, 'show'])->name('admin.catalog.show');
    Route::get('/admin/catalog/{id}/edit', [CatalogController::class, 'edit'])->name('admin.catalog.edit');
    Route::put('/admin/catalog/{id}/update', [CatalogController::class, 'update'])->name('admin.catalog.update');
    Route::delete('/admin/catalog/{id}/delete', [CatalogController::class, 'destroy'])->name('admin.catalog.delete');
    Route::delete('/admin/catalog/{id}/delete-image', [CatalogController::class, 'destroyImage'])->name('admin.catalog.delete-image');

    Route::get('/admin/order/{method}', [OrderController::class, 'index'])->name('admin.order');
    Route::get('/admin/order/history', [OrderController::class, 'send'])->name('admin.history');
    Route::get('/admin/order/add', [OrderController::class, 'create'])->name('admin.order.create');
    Route::post('/admin/order/store', [OrderController::class, 'store'])->name('admin.order.store');
    Route::get('/admin/order/{id}/show', [OrderController::class, 'show'])->name('admin.order.show');
    Route::get('/admin/order/history/{id}/show', [OrderController::class, 'show'])->name('admin.history.show');
    Route::put('/admin/order/{id}/verified', [OrderController::class, 'verified'])->name('admin.order.verified');
    Route::get('/admin/order/{id}/edit', [OrderController::class, 'edit'])->name('admin.order.edit');
    Route::put('/admin/order/{id}/update', [OrderController::class, 'update'])->name('admin.order.update');
    Route::delete('/admin/order/{id}/delete', [OrderController::class, 'destroy'])->name('admin.order.delete');
    Route::delete('/admin/order/{id}/delete-image', [OrderController::class, 'destroyImage'])->name('admin.order.delete-image');

    Route::get('/admin/gallery', [CatalogController::class, 'gallery'])->name('admin.gallery');

    Route::get('/admin/video', [VideoController::class, 'index'])->name('admin.video');
    Route::get('/admin/video/add', [VideoController::class, 'create'])->name('admin.video.create');
    Route::post('/admin/video/store', [VideoController::class, 'store'])->name('admin.video.store');
    Route::delete('/admin/video/{id}/delete', [VideoController::class, 'destroy'])->name('admin.video.delete');

    Route::get('/admin/information', [InformationController::class, 'index'])->name('admin.information');
    Route::get('/admin/information/add', [InformationController::class, 'create'])->name('admin.information.create');
    Route::post('/admin/information/store', [InformationController::class, 'store'])->name('admin.information.store');
    Route::delete('/admin/information/{id}/delete', [InformationController::class, 'destroy'])->name('admin.information.delete');

    Route::get('/admin/main-slider', [MainSliderController::class, 'index'])->name('admin.main-slider');
    Route::get('/admin/main-slider/add', [MainSliderController::class, 'create'])->name('admin.main-slider.create');
    Route::post('/admin/main-slider/store', [MainSliderController::class, 'store'])->name('admin.main-slider.store');
    Route::get('/admin/main-slider/{id}/edit', [MainSliderController::class, 'edit'])->name('admin.main-slider.edit');
    Route::put('/admin/main-slider/{id}/update', [MainSliderController::class, 'update'])->name('admin.main-slider.update');
    Route::delete('/admin/main-slider/{id}/delete', [MainSliderController::class, 'destroy'])->name('admin.main-slider.delete');

    Route::get('/admin/review-slider', [ReviewSliderController::class, 'index'])->name('admin.review-slider');
    Route::get('/admin/review-slider/add', [ReviewSliderController::class, 'create'])->name('admin.review-slider.create');
    Route::post('/admin/review-slider/store', [ReviewSliderController::class, 'store'])->name('admin.review-slider.store');
    Route::get('/admin/review-slider/{id}/edit', [ReviewSliderController::class, 'edit'])->name('admin.review-slider.edit');
    Route::put('/admin/review-slider/{id}/update', [ReviewSliderController::class, 'update'])->name('admin.review-slider.update');
    Route::delete('/admin/review-slider/{id}/delete', [ReviewSliderController::class, 'destroy'])->name('admin.review-slider.delete');

    Route::get('/admin/about-us', [AboutUsController::class, 'index'])->name('admin.about-us');
    Route::put('/admin/about-us/{id}/update', [AboutUsController::class, 'update'])->name('admin.about-us.update');

    Route::get('/admin/account-setting', [AdminController::class, 'accountSetting'])->name('admin.account-setting');
    Route::put('/admin/payment', [AdminController::class, 'payment'])->name('admin.payment');
    Route::put('/admin/change-password/{id}', [AdminController::class, 'changePassword'])->name('admin.change-password');
    Route::put('/admin/change-information/{id}', [AdminController::class, 'changeInformation'])->name('admin.change-information');


});