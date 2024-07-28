<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\BlogCategory;
use App\Http\Requests\admin\BlogCategoryRequest;
use Illuminate\Support\Facades\Auth;

class BlogCategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $title = "Danh mục bài viết";
        $allCate = BlogCategory::query()->paginate(5)->withQueryString();
        // Kiểm tra nếu người dùng đã đăng nhập bằng guard 'admin' 
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user()->fullname;
            return view('layouts.backend.blog_category.lists', compact('title', 'allCate','user'));
        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    }
    public function add()
    {
        $title = "Thêm mới danh mục bài viết";
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user()->fullname;
            return view('layouts.backend.blog_category.add', compact('title','user'));
        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');

    }
    public function postAdd(BlogCategoryRequest $request)
    {
        $dataIntert = [
            'name' => $request->name,
            'short_description' => $request->short_description,
            'created_at' => date('Y-m-d H:i:s')
        ];
        // dd($dataIntert);
        BlogCategory::create($dataIntert);
        return redirect()->route('admin.cates.index')->with('msg', "Thêm danh mục bài viết thành công");
    }
    public function edit($id)
    {
        $title = "Cập nhật danh mục bài viết";
        $cates = BlogCategory::find($id);
        if (!$cates) {
            return redirect()->route('admin.cates.index')->with('msg_warning', 'Danh mục bài viết không tồn tại');
        }
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user()->fullname;
            return view('layouts.backend.blog_category.edit', compact('title', 'cates','user'));

        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    }
    public function postEdit(BlogCategoryRequest $request, $id)
    {
        $cates = BlogCategory::find($id);

        if (!$cates) {
            return redirect()->route('admin.cates.index')->with('msg_warning', 'Danh mục bài viết không tồn tại');
        }
        $dataUpdate = [
            'name' => $request->name,
            'short_description' => $request->short_description,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        // dd($dataUpdate);
        // die;
        // BlogCategory::postEdit($id, $dataUpdate);
        $blogCategory = new \App\Models\admin\BlogCategory();
        $blogCategory->postEdit($id, $dataUpdate);
        return back()->with('msg', "Sửa danh mục thành công");
    }



    public function delete($id)
    {
        $cates = BlogCategory::find($id);
        if($cates){
            $blogCount = $cates->Blog()->count();
            if($blogCount>0){
                return redirect()->route('admin.cates.index')->with('msg_warning',"Không thể xóa danh mục này vì còn $blogCount bài viết đã được sử dụng");
            
            }
            BlogCategory::destroy($id);
            return redirect()->route('admin.cates.index')->with('msg', "Xóa danh mục bài viết thành công");
        }
        return redirect()->route('admin.cates.index')->with('msg_warning', "Danh mục bài viết không tồn tại");
       
    }
}
