<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AddressController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\LoginController;
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


Route::get('/',[HomeController::class, 'index']);
Route::get('/category/{category:slug}', [\App\Http\Controllers\Frontend\CategoryController::class, 'index']);


Route::middleware('auth')->group(function () {
Route::get('/dashboard',[HomeController::class, 'dashboard']);
    Route::resource('/users',UserController::class);
Route::get('/users/{user}/change-password',[UserController::class, 'passwordForm']);
Route::post('/users/{user}/change-password',[UserController::class, 'changePassword']);
Route::resource('/users/{user}/address',AddressController::class);
Route::resource('/categories',CategoryController::class);
Route::resource('/products',ProductController::class);
Route::resource('/products/{product}/images',ProductImageController::class);
    Route::get("/addtocart", [CartController::class, 'index']);
    Route::get("/addtocart/add/{product}", [CartController::class, 'add']);
    Route::get("/addtocart/remove/{cartDetails}", [CartController::class, 'remove']);

    Route::get("/checkout", [CheckoutController::class, 'index']);
    Route::post("/checkout", [CheckoutController::class, 'checkout']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/welcome', [HomeController::class, 'welcome']);


Route::prefix('{locale?}')->middleware('language')->group(function () {
    Route::get('/welcome', [HomeController::class, 'welcome']);
});



Route::get('/redirect', [LoginController::class, 'redirect']);
Route::get('/callback', [LoginController::class, 'callback']);




require __DIR__.'/auth.php';

