<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('layouts/backend');
});

Route::get('/client', function () {
    return view('layouts/clients');
});

Route::get('/product', function () {
    return view('layouts/products');
});

Route::get('/detail', function () {
    return view('layouts/product_detail');
});

Route::get('/blog', function () {
    return view('layouts/blog');
});

Route::get('/blog-detail', function () {
    return view('layouts/blog_detail');
});

Route::get('/login', function () {
    return view('layouts/auth_login');
});

Route::get('/contact', function () {
    return view('layouts/contact');
});


Route::prefix('/admin')->name('admin.')->group(function(){
    Route::get('/', function(){
        return view('layouts.backend.backend');
    });


Route::prefix('/product')->name('product.')->group(function(){
    Route:: get('/product', [ProductController::class,'index'])->name('lists');
});
});

