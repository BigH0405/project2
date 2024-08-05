<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ReviewRequest;
use App\Models\admin\Reviews;
use App\Models\clients\Products;
use App\Models\clients\ProductsCate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index(Request $request){
        $title="Sản phẩm";
        $bestSellingProducts = Products::orderBy('quanlity', 'asc')->limit(9)->get();
        $query = Products::query();
        $allCate = ProductsCate::get();
        $nav = ProductsCate::get();
        $search = null;
        $search = $request->input('keywords');
        if ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        }
        $allProducts=$query->orderBy('id','DESC')->paginate(6)->withQueryString();
        if (Auth::guard('web')->check()) {
            // Lấy thông tin người dùng từ guard 'web'
            $user = Auth::guard('web')->user();
            return view('layouts.clients.products',compact('user','allProducts','allCate','bestSellingProducts','nav','title'));
        }
        // Chuyển hướng tới trang đăng nhập với thông báo cảnh báo
        return view('layouts.clients.products',compact('allProducts','allCate','bestSellingProducts','nav','title'));
    }
    public function show($id){
        $title="Chi tiết sản phẩm";
        $product =  Products::find($id);
        $nav = ProductsCate::get();
        $bestSellingProducts = Products::orderBy('quanlity', 'asc')->limit(9)->get();

        if(!$product) {
            return redirect()->route('layouts.clients.product_detail',['id'=>$id])->with('msg_warning', 'Sản phẩm không tồn tại');
        }
        if (Auth::guard('web')->check()) {
            // Lấy thông tin người dùng từ guard 'web'
            $user = Auth::guard('web')->user();
            return view('layouts.clients.product_detail',['id'=>$id],compact('user','product','bestSellingProducts','nav','title'));
        }
        return view('layouts.clients.product_detail',['id'=>$id],compact('product','bestSellingProducts','nav','title'));
    }
    public function productsByCategory($id)
{
    // Lấy danh mục theo ID
    $category = ProductsCate::find($id);

    if (!$category) {
        return redirect()->route('products.index')->with('error', 'Category not found');
    }

    $title = 'Sản phẩm theo danh mục';
    // Thiết lập title với tên danh mục
    $title1 = "Sản phẩm theo danh mục: " . $category->name;

    // Lấy các sản phẩm bán chạy nhất và tất cả các danh mục
    $bestSellingProducts = Products::orderBy('quanlity', 'desc')->limit(9)->get();
    $allCate = ProductsCate::all();
    $nav = ProductsCate::all();

    // Lấy tất cả các sản phẩm thuộc danh mục
    $allProducts = $category->products()->orderBy('id', 'DESC')->paginate(6)->withQueryString();

    // Kiểm tra người dùng đăng nhập
    if (Auth::guard('web')->check()) {
        $user = Auth::guard('web')->user();
        return view('layouts.clients.products', compact('user', 'allProducts', 'allCate', 'bestSellingProducts', 'nav', 'title','title1'));
    }

    return view('layouts.clients.products', compact('allProducts', 'allCate', 'bestSellingProducts', 'nav', 'title','title1'));
}

}
