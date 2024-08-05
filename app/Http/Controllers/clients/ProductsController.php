<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ReviewRequest;
use App\Models\admin\Reviews;
use App\Models\clients\Products;
use App\Models\clients\ProductsCate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\clients\ReviewClients;
use App\Http\Requests\client\ReviewCLientsRequest;
use App\Models\admin\Users;

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
    public function show($id)
    {
        $title = "Chi tiết sản phẩm";
        $product = Products::find($id);
        $nav = ProductsCate::get();
        $bestSellingProducts = Products::orderBy('quanlity', 'asc')->limit(9)->get();
    
        if (!$product) {
            return redirect()->route('layouts.clients.product_detail', ['id' => $id])->with('msg_warning', 'Sản phẩm không tồn tại');
        }
    
        // Lấy tất cả review của sản phẩm cụ thể cùng với thông tin người dùng
        $allReviews = $product->reviews()->with('User')->orderBy('created_at', 'desc')->get();
    
            if (Auth::guard('web')->check()) {
                // Lấy thông tin người dùng từ guard 'web'
                $user = Auth::guard('web')->user();
                return view('layouts.clients.product_detail', compact('user', 'product', 'bestSellingProducts', 'nav', 'title', 'allReviews'));
            }
        
            return view('layouts.clients.product_detail', compact('product', 'bestSellingProducts', 'nav', 'title', 'allReviews'));
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

public function storeReview(Request $request, $id)
{
    $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'messege' => 'required|string|max:255',
    ], [
        'fullname.required' => 'Tên không được để trống',
        'fullname.string' => 'Tên phải là một chuỗi ký tự.',
        'fullname.max' => 'Tên không được vượt quá 255 ký tự.',
        'email.required' => 'Email không được để trống',
        'email.email' => 'Email không đúng định dạng',
        'email.max' => 'Email không được vượt quá 255 ký tự.',
        'messege.required' => 'Đánh giá không được để trống',
        'messege.string' => 'Đánh giá phải là một chuỗi ký tự.',
        'messege.max' => 'Đánh giá không được vượt quá 255 ký tự.',
    ]);

    // Kiểm tra xem người dùng đã tồn tại chưa, nếu chưa thì tạo mới
    $user = Users::firstOrCreate(
        ['email' => $request->email],
        ['name' => $request->fullname]
    );

    // Lưu đánh giá
    $review = new ReviewClients;
    $review->user_id = $user->id;
    $review->product_id = $id;
    $review->messege = $request->messege;
    $review->created_at = now();
    $review->updated_at = now();
    $review->save();

    return back()->with('msg_success', 'Đánh giá của bạn đã được gửi.');
}



}
