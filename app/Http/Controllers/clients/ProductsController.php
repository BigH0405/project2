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
            $user = Auth::guard('web')->user()->fullname;
            return view('layouts.clients.products',compact('user','allProducts','allCate','bestSellingProducts','nav','title'));
        }
        // Chuyển hướng tới trang đăng nhập với thông báo cảnh báo
        return view('layouts.clients.products',compact('allProducts','allCate','bestSellingProducts','nav','title'));
    }
    public function show( $id){
        $title="Chi tiết sản phẩm";
        $product =  Products::find($id);
        $nav = ProductsCate::get();
        $bestSellingProducts = Products::orderBy('quanlity', 'asc')->limit(9)->get();

        if(!$product) {
            return redirect()->route('layouts.clients.product_detail',['id'=>$id])->with('msg_warning', 'Sản phẩm không tồn tại');
        }
        if (Auth::guard('web')->check()) {
            // Lấy thông tin người dùng từ guard 'web'
            $user = Auth::guard('web')->user()->fullname;
            return view('layouts.clients.product_detail',['id'=>$id],compact('user','product','bestSellingProducts','nav','title'));
        }
        return view('layouts.clients.product_detail',['id'=>$id],compact('product','bestSellingProducts','nav','title'));
    }
    public function showcate( $id){
        $nav = ProductsCate::get();
        $product =  Products::find($id);
        if (Auth::guard('web')->check()) {
            // Lấy thông tin người dùng từ guard 'web'
            $user = Auth::guard('web')->user()->fullname;
            return view('layouts.clients.product_detail',['id'=>$id],compact('user'));
        }
        return view('layouts.clients.product_detail',['id'=>$id],compact('nav'));
    }

}
