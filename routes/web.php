<?php

use App\Http\Controllers\admin\BlogCategoryController;
use App\Http\Controllers\admin\CouponController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\admin\GroupController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\auth\DashboardController;
use App\Http\Controllers\admin\auth\LoginController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/products', function () {
    return view('layouts/products');
});
// Route admin
Route::prefix('/admin')->name('admin.')->group(function(){
    //Route Dashboard admin
    Route::get('/',[DashboardController::class,'index'])->middleware('auth:admin')->name('index');

    //Route đăng nhập + đăng ký
    Route::get('/login',[LoginController::class,'login'])->middleware('guest:admin')->name('login');
    Route::post('/login',[LoginController::class,'Postlogin'])->middleware('guest:admin')->name('post-login');

    Route::post('logout', function(){
    Auth::guard('admin')->logout();
    return redirect()->route('admin.login');
    })->middleware('auth:admin')->name('logout');

   


//Route sản phẩm
Route::prefix('/product')->middleware('auth:admin')->name('product.')->group(function(){
    Route:: get('/', [ProductController::class,'index'])->name('index');
    Route::get('/add',[ProductController::class,'add'])->name('add');
    Route:: post('/add', [ProductController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [ProductController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [ProductController::class,'postEdit'])->name('post-edit');
    Route:: get('/delete/{id}', [ProductController::class,'delete'])->name('delete');
});

// Route danh sách sản phẩm
Route::prefix('/cate')->middleware('auth:admin')->name('cate.')->group(function(){
    Route:: get('/', [ProductCategoryController::class,'index'])->name('index');
    Route::get('/add',[ProductCategoryController::class,'add'])->name('add');
    Route:: post('/add', [ProductCategoryController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [ProductCategoryController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [ProductCategoryController::class,'postEdit'])->name('post-edit');
    Route:: get('/delete/{id}', [ProductCategoryController::class,'delete'])->name('delete');
});

// Route danh sách khuyễn mãi
Route::prefix('/coupons')->middleware('auth:admin')->name('coupons.')->group(function(){
    Route:: get('/', [CouponController::class,'index'])->name('index');
    Route::get('/add',[CouponController::class,'add'])->name('add');
    Route:: post('/add', [CouponController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [CouponController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [CouponController::class,'postEdit'])->name('post-edit');
    Route:: get('/delete/{id}', [CouponController::class,'delete'])->name('delete');
});

// Route blog
Route::prefix('/blog')->middleware('auth:admin')->name('blog.')->group(function(){
    Route:: get('/', [BlogController::class,'index'])->name('index');
    Route:: get('/add', [BlogController::class,'add'])->name('add');
    Route:: post('/add', [BlogController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [BlogController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [BlogController::class,'postEdit'])->name('post-edit');
    Route::get('/delete/{id}',[BlogController::class,'delete'])->name('delete');
});

// Route user
Route::prefix('/user')->middleware('auth:admin')->name('user.')->group(function(){
    Route:: get('/', [UserController::class,'index'])->name('index');
    Route::get('/add',[UserController::class,'add'])->name('add');
    Route:: post('/add', [UserController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [UserController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [UserController::class,'postEdit'])->name('post-edit');
    Route:: get('/delete/{id}', [UserController::class,'delete'])->name('delete');
});

// Route group
Route::prefix('/group')->middleware('auth:admin')->name('group.')->group(function(){
    Route:: get('/', [GroupController::class,'index'])->name('index');
    Route::get('/add',[GroupController::class,'add'])->name('add');
    Route:: post('/add', [GroupController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [GroupController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [GroupController::class,'postEdit'])->name('post-edit');
    Route:: get('/delete/{id}', [GroupController::class,'delete'])->name('delete');
});

// Route Danh mục Blog
Route::prefix('/cates')->middleware('auth:admin')->name('cates.')->group(function(){
    Route:: get('/', [BlogCategoryController::class,'index'])->name('index');
    Route:: get('/add', [BlogCategoryController::class,'add'])->name('add');
    Route:: post('/add', [BlogCategoryController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [BlogCategoryController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [BlogCategoryController::class,'postEdit'])->name('post-edit');
    Route::get('/delete/{id}',[BlogCategoryController::class,'delete'])->name('delete');
});

});
// Kết thúc route admin



// Route clients
Route::prefix('/')->name('clients.')->group(function(){
    Route:: get('/', [HomeController::class,'index'])->name('lists');
    

});
// Kết thúc route clients


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
