<?php

use App\Http\Controllers\admin\CouponController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\admin\GroupController;
use App\Http\Controllers\admin\UserController;
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

// Route admin
Route::prefix('/admin')->name('admin.')->group(function(){
    Route::get('/', function(){
        return view('layouts.backend.backend');
    });

//Route sản phẩm
Route::prefix('/product')->name('product.')->group(function(){
    Route:: get('/', [ProductController::class,'index'])->name('index');
    Route::get('/add',[ProductController::class,'add'])->name('add');
    Route:: post('/add', [ProductController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [ProductController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [ProductController::class,'postEdit'])->name('post-edit');
    Route:: get('/delete/{id}', [ProductController::class,'delete'])->name('delete');
});

// Route danh sách sản phẩm
Route::prefix('/cate')->name('cate.')->group(function(){
    Route:: get('/', [ProductCategoryController::class,'index'])->name('index');
    Route::get('/add',[ProductCategoryController::class,'add'])->name('add');
    Route:: post('/add', [ProductCategoryController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [ProductCategoryController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [ProductCategoryController::class,'postEdit'])->name('post-edit');
    Route:: get('/delete/{id}', [ProductCategoryController::class,'delete'])->name('delete');
});

// Route danh sách khuyễn mãi
Route::prefix('/coupons')->name('coupons.')->group(function(){
    Route:: get('/', [CouponController::class,'index'])->name('index');
    Route::get('/add',[CouponController::class,'add'])->name('add');
    Route:: post('/add', [CouponController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [CouponController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [CouponController::class,'postEdit'])->name('post-edit');
    Route:: get('/delete/{id}', [CouponController::class,'delete'])->name('delete');
});

// Route blog
Route::prefix('/blog')->name('blog.')->group(function(){
    Route:: get('/', [BlogController::class,'index'])->name('index');
    Route:: get('/add', [BlogController::class,'add'])->name('add');
});

// Route user
Route::prefix('/user')->name('user.')->group(function(){
    Route:: get('/', [UserController::class,'index'])->name('index');
    Route::get('/add',[UserController::class,'add'])->name('add');
    Route:: post('/add', [UserController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [UserController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [UserController::class,'postEdit'])->name('post-edit');
    Route:: get('/delete/{id}', [UserController::class,'delete'])->name('delete');
});

// Route group
Route::prefix('/group')->name('group.')->group(function(){
    Route:: get('/', [GroupController::class,'index'])->name('index');
    Route::get('/add',[GroupController::class,'add'])->name('add');
    Route:: post('/add', [GroupController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [GroupController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [GroupController::class,'postEdit'])->name('post-edit');
    Route:: get('/delete/{id}', [GroupController::class,'delete'])->name('delete');
});


});
// Kết thúc route admin


// Route clients
Route::prefix('/')->name('clients.')->group(function(){
    Route:: get('/', [HomeController::class,'index'])->name('lists');
    

});
// Kết thúc route clientssw

