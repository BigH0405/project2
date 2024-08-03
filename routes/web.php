<?php

use App\Http\Controllers\admin\BlogCategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\admin\GroupController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\auth\DashboardController;
use App\Http\Controllers\admin\auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\auth\ForgotPasswordController;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\auth\RestPasswordController;
use App\Http\Controllers\clients\ProductsController;
use App\Http\Controllers\clients\BlogClientController;
use App\Http\Controllers\clients\ContactClientController;
use App\Http\Controllers\clients\auth\LoginClientController;
use App\Http\Controllers\clients\auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\clients\auth\VerifyClientsController;
use App\Http\Controllers\clients\auth\ForgotPasswordClientController;
use App\Http\Controllers\clients\auth\RestPasswordClientController;
use App\Http\Controllers\clients\CartController;

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




// Route::get('/detail', function () {
//     return view('layouts/product_detail');
// });

// Route::get('/blog', function () {
//     return view('layouts/blog');
// });

// Route::get('/blog-detail', function () {
//     return view('layouts/blog_detail');
// });

// Route::get('/login', function () {
//     return view('layouts/auth_login');
// });

// Route::get('/contact', function () {
//     return view('layouts/contact');
// });

// Route::get('/products', function () {
//     return view('layouts/products');
// });



// Route admin
Route::prefix('/admin')->name('admin.')->group(function(){
    //Route Dashboard admin
    Route::get('/',[DashboardController::class,'index'])->middleware('auth:admin')->name('index');
/**********************************************Login-Register*********************************************************/
    //Route đăng nhập
    Route::get('/login',[LoginController::class,'login'])->middleware('guest:admin')->name('login');
    Route::post('/login',[LoginController::class,'Postlogin'])->middleware('guest:admin')->name('post-login');
    //Đăng xuất
    Route::post('/logout', function(){
    Auth::guard('admin')->logout();
    return redirect()->route('clients.lists');
    })->middleware('auth:admin')->name('logout');

// Route hiển thị form quên mật khẩu
    Route::get('/forgot-password', [ForgotPasswordController::class, 'getForgotPassword'])
    ->middleware('guest:admin')
    ->name('forgot-password');

// Route xử lý yêu cầu POST để gửi email đặt lại mật khẩu
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('guest:admin')
    ->name('sendResetLinkEmail');
//  Route xử lý form xác nhận mật khẩu
    Route::get('reset-password/{token}', [RestPasswordController::class,'showResetForm'])->middleware('guest:admin')->name('rest-password');
    Route::post('reset-password', [RestPasswordController::class,'reset'])->middleware('guest:admin')->name('update-password');

/**********************************************END Login-Register*********************************************************/

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
// route contacts
Route::prefix('/contacts')->name('contacts.')->group(function(){
    Route::get('/',[ContactController::class,'index'])->name('index');
    Route:: get('/add', [ContactController::class,'add'])->name('add');
    Route:: post('/add', [ContactController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [ContactController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [ContactController::class,'postEdit'])->name('post-edit');
    Route::get('/delete/{id}',[ContactController::class,'delete'])->name('delete');

});
// route comments
Route::prefix('/comments')->name('comments.')->group(function(){
    Route::get('/',[CommentController::class,'index'])->name('index');
    Route:: get('/add', [CommentController::class,'add'])->name('add');
    Route:: post('/add', [CommentController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [CommentController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [CommentController::class,'postEdit'])->name('post-edit');
    Route::get('/delete/{id}',[CommentController::class,'delete'])->name('delete');

});
//route reviews
Route::prefix('/reviews')->name('reviews.')->group(function(){
    Route::get('/',[ReviewController::class,'index'])->name('index');
    Route:: get('/add', [ReviewController::class,'add'])->name('add');
    Route:: post('/add', [ReviewController::class,'postAdd'])->name('post-add');
    Route:: get('/edit/{id}', [ReviewController::class,'edit'])->name('edit');
    Route:: post('/edit/{id}', [ReviewController::class,'postEdit'])->name('post-edit');
    Route::get('/delete/{id}',[ReviewController::class,'delete'])->name('delete');

});
});

// Kết thúc route admin

Route::get('/email/verify', function () {
    return redirect()->route('clients.verify');
})->middleware('auth:web')->name('verification.notice');
//
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('register');
})->middleware(['auth:web', 'signed'])->name('verification.verify');
//
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Một đường link đã được gửi tới bạn!');
})->middleware(['auth:web', 'throttle:6,1'])->name('verification.resend');

// Route clients
Route::prefix('/')->name('clients.')->group(function(){
    /**********************************************END Login-Register*********************************************************/
    // Route đăng nhập
    Route::get('/login', [LoginClientController::class, 'login'])->middleware('guest:web')->name('login');
    Route::post('/login', [LoginClientController::class, 'postLogin'])->middleware('guest:web')->name('post-login');

    // Route đăng ký
    Route::get('/register', [RegisterController::class,'showRegistrationForm'])->middleware('guest:web')->name('register');
    Route::post('/register', [RegisterController::class,'register'])->middleware('guest:web')->name('post-register');

    // Route form xác minh email
    Route::get('/verify', [VerifyClientsController::class,'show'])->name('verify');

    // Route form quên mật khẩu
    Route::get('/forgot-password', [ForgotPasswordClientController::class,'getForgotPassword'])->middleware('guest:web')->name('forgot-password');
    Route::post('/forgot-password', [ForgotPasswordClientController::class, 'sendResetLinkEmail'])->middleware('guest:web')
    ->name('sendResetLinkEmail');

    // Hiện form đổi mật khẩu
    Route::get('reset-password/{token}', [RestPasswordClientController::class,'showResetForm'])->middleware('guest:web')->name('rest-password');
    Route::post('reset-password', [RestPasswordController::class,'reset'])->middleware('guest:web')->name('update-password');

    // Đăng xuất
    Route::post('/logout', function(){
        Auth::guard('web')->logout();
        return redirect()->route('clients.lists');
    })->middleware('auth:web')->name('logout');


    // Các route yêu cầu email đã xác minh
    Route::middleware(['auth:web', 'verified'])->group(function() {
        // Các route yêu cầu xác minh email ở đây, nếu có
       
    });

    /**********************************************END Login-Register*********************************************************/

    // Các route công khai
    // Route clients trang chủ
    Route::get('/', [HomeController::class,'index'])->name('lists');
    // Route clients sản phẩm
    Route::get('/products',[ProductsController::class,'index'])->name('products');
    Route::get('/products/{id}',[ProductsController::class,'show'])->name('product_detail');
    // Route clients blogs
    Route::get('/blogs',[BlogClientController::class,'index'])->name('blogs');
    // Route clients liên hệ
    
    Route::get('/contacts',[ContactClientController::class,'index'])->name('contacts');
    Route::post('/contacts',[ContactClientController::class,'postContacts'])->name('post-contacts');

    Route::get('/cart',[CartController::class,'index'])->name('cart');

});
// Kết thúc route clients

  

