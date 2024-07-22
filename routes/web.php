<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\PromotionController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\clients\HomeController;
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

// Route khuyến mãi
Route::prefix('/sale')->name('sale.')->group(function(){
    Route::get('/',[PromotionController::class, 'index'])->name('index');
    Route::get('/add',[PromotionController::class,'add'])->name('add');
    Route:: post('/add', [PromotionController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [PromotionController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [PromotionController::class,'postEdit'])->name('post-edit');
    Route:: get('/delete/{id}', [PromotionController::class,'delete'])->name('delete');
});
// Route blog
Route::prefix('/blog')->name('blog.')->group(function(){
    Route:: get('/', [BlogController::class,'index'])->name('index');
});


});
// Kết thúc route admin


// Route clients
Route::prefix('/')->name('clients.')->group(function(){
    Route:: get('/', [HomeController::class,'index'])->name('lists');
    

});
// Kết thúc route clientssw

