<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductCate;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('products')->name('products.')->group(function () {
        //http://127.0.0.1:8000/api/admin/products
        Route::get('/', [ProductCate::class, 'index'])->name('index');
        //http://127.0.0.1:8000/api/admin/products/11
        Route::get('/{id}', [ProductCate::class, 'show'])->name('detail');
        //http://127.0.0.1:8000/api/admin/products POST
        Route::post('/', [ProductCate::class, 'store'])->name('store');
        //http://127.0.0.1:8000/api/admin/products/13 PUT
        Route::put('/{id}', [ProductCate::class, 'update'])->name('update');
        //http://127.0.0.1:8000/api/admin/products/13 DELETE
        Route::delete('/{id}', [ProductCate::class, 'destroy'])->name('destroy');
    });
});
