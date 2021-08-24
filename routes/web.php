<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['middleware'=>['notlogin']], function(){

	Route::get('/confirm/{id}', [App\Http\Controllers\Auth\VerificationController::class, 'index'])->name('confirm');
	Route::get('/', function () {
	    return view('welcome');
	});

});
	Auth::routes();


Route::group(['prefix' => 'admin','namespace' => 'Admin','as'=>'admin.','middleware'=>['admin']], function(){

	Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

	Route::get('/product', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product');

	Route::get('/product/active/{id}', [App\Http\Controllers\Admin\ProductController::class, 'active'])->name('product.active');
	Route::get('/product/block/{id}', [App\Http\Controllers\Admin\ProductController::class, 'block'])->name('product.block');
	Route::get('/product/unblock/{id}', [App\Http\Controllers\Admin\ProductController::class, 'unblock'])->name('product.unblock');

	Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category');
	Route::get('/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
	Route::get('/category/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
	Route::get('/category/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('category.delete');
	Route::post('/category/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store');
	Route::post('/category/update/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.update');

});

Route::group(['namespace' => 'User','as'=>'user.','middleware'=>['user']], function(){

	Route::get('/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');

	Route::get('/product', [App\Http\Controllers\User\ProductController::class, 'index'])->name('product');
	Route::get('/product/create', [App\Http\Controllers\User\ProductController::class, 'create'])->name('product.create');
	Route::get('/product/edit/{id}', [App\Http\Controllers\User\ProductController::class, 'edit'])->name('product.edit');
	Route::get('/product/delete/{id}', [App\Http\Controllers\User\ProductController::class, 'delete'])->name('product.delete');
	Route::post('/product/store', [App\Http\Controllers\User\ProductController::class, 'store'])->name('product.store');
	Route::post('/product/update/{id}', [App\Http\Controllers\User\ProductController::class, 'update'])->name('product.update');
});

