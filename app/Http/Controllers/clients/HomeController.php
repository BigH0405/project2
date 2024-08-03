<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\clients\ProductsCate;
use App\Models\clients\Products;


class HomeController extends Controller
{

    public function index()
{
    // Lấy sản phẩm bán chạy nhất
    $bestSellingProducts = Products::orderBy('quanlity', 'asc')->limit(9)->get();
    $nav = ProductsCate::get();
    $products = Products::orderBy("id","desc")->limit(8)->get();
    $productBanner = Products::orderBy("id","desc")->limit(5)->get();
    //Limit 1 danh mục
    $allCate = ProductsCate::orderBy("id", "desc")->limit(1)->get();
    // Kiểm tra nếu người dùng đã đăng nhập bằng guard 'web'
    if (Auth::guard('web')->check()) {
        // Lấy thông tin người dùng từ guard 'web'
        $user = Auth::guard('web')->user()->fullname;
        return view('layouts.clients.clients', compact('user','products','allCate','bestSellingProducts','productBanner','nav'));
    }

    return view('layouts.clients.clients', compact('products','allCate','bestSellingProducts','productBanner','nav'));
}

}
