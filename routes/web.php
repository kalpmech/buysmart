<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use Illuminate\Support\Facades\Auth;

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

    Route::get('/', [FrontendProductController::class,'homePage'])->name('home');
    Route::get('/women', [FrontendProductController::class,'womenPage'])->name('women');
    Route::get('/men', [FrontendProductController::class,'manPage'])->name('men');
    Route::get('/kids', [FrontendProductController::class,'kidsPage'])->name('kids');
    Route::get('/contactus', [FrontendProductController::class,'contactus'])->name('contactus');
    Route::get('{type}/product-deatils/{id}', [FrontendProductController::class,'show'])->name('product-details');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/placeOrder', [FrontendOrderController::class,'placeOrder'])->name('orders.place');
    });

    Route::group(['prefix' => 'cart','middleware' => 'auth'], function () {
        Route::get('/', [CartController::class, 'index'])->name('cart');
        Route::post('/store', [CartController::class, 'store'])->name('cart-store');
        Route::post('/update', [CartController::class, 'updateCart'])->name('cart-update');
        Route::get('/remove/{id}', [CartController::class, 'removeCart'])->name('cart-remove');
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => 'auth'], function () {
        Route::resource('users', UserController::class);
        Route::get('users/destory/{id}',[UserController::class, 'destroy'])->name('users.destory');
        Route::resource('categories', CategoryController::class);
        Route::get('categories/destory/{id}',[CategoryController::class, 'destroy'])->name('categories.destory');
        Route::resource('products', ProductController::class);
        Route::get('products/destory/{id}',[ProductController::class, 'destroy'])->name('products.destory');
        Route::resource('orders', OrderController::class);
        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard'], function () {
            Route::get('/', function () { return view('admin.dashboard'); });
        });
    });
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Auth::routes();

