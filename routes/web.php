<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
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

Route::get('/', function () {
    return view('welcome');
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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Auth::routes();

