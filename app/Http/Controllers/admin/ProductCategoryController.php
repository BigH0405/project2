<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\ProductCategory;
use App\Http\Requests\admin\ProductCategoryRequest;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    public function index(Request $request){
        $title = "Danh sách sản phẩm";
        $search = null;
        $search = $request->input('keywords');
        $query = ProductCategory::query();

        if ($search) {
        $query->where('name', 'like', '%'.$search.'%');
        }

        $allCate = $query->orderBy('id','DESC')->paginate(3)->withQueryString();
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user();
            return view('layouts.backend.product_category.lists',compact('title','allCate','user'));

        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    }

    public function add(){
        $title = "Thêm mới danh sách sản phẩm";
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user();
            return view('layouts.backend.product_category.add',compact('title','user'));
        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
        
    }

    public function postAdd(ProductCategoryRequest $request){
        $dataInsert = [
            'name' => $request->name,
            'create_at'=>date('Y-m-d H:i:s')
        ];
        ProductCategory::create($dataInsert);
        return redirect()->route('admin.cate.index')->with('msg',"Thêm danh mục thành công");   
    }

    public function edit($id){
        $title = "Cập nhập danh mục sản phẩm";
        $cate = ProductCategory::find($id);
        if(!$cate) {
            return redirect()->route('admin.cate.index')->with('msg_warning', 'Danh mục không tồn tại');
        }
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user();
            return view('layouts.backend.product_category.edit',compact('title','cate','user'));
        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    }

    public function postEdit(ProductCategoryRequest $request, $id){
        $cate = ProductCategory::find($id);

        if(!$cate) {
            return redirect()->route('admin.cate.index')->with('msg_warning', 'Danh mục không tồn tại');
        }

        $dataUpdate = [
            'name' => $request->name,
        ];

        ProductCategory::postEdit($id, $dataUpdate);

        return back()->with('msg', "Sửa danh mục thành công");
    }

    public function delete($id) {
        $cate = ProductCategory::find($id);
    
        if ($cate) {
            // Đếm số sản phẩm liên quan đến danh mục sản phẩm
            $productCount = $cate->products()->count();
    
            // Kiểm tra nếu có sản phẩm liên quan
            if ($productCount > 0) {
                // Hiển thị thông báo lỗi và trả về trang danh mục sản phẩm
                return redirect()->route('admin.cate.index')
                                 ->with('msg_warning', "Không thể xóa danh mục này vì còn $productCount sản phẩm đang sử dụng!");
            }
    
            // Tiến hành xóa danh mục sản phẩm
            ProductCategory::destroy($id);
            return redirect()->route('admin.cate.index')->with('msg', "Xóa danh mục thành công");
        }
    
        return redirect()->route('admin.cate.index')->with('msg_warning', "Danh mục không tồn tại.");
    }
}
