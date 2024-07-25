<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\BlogCategory;

// use App\Http\Requests\admin\BlogCategoryRequest;


class BlogCategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $title = "Danh sách bài viết";

        $allCate = BlogCategory::query()->paginate(5)->withQueryString();

        return view('layouts.backend.blog_category.lists', compact('title', 'allCate'));

    }
    public function add()
    {
        $title = "Thêm mới danh sách bài viết";

        return view('layouts.backend.blog_category.add', compact('title'));

    }
    public function postAdd(Request $request)
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
        return view('layouts.backend.blog_category.edit', compact('title', 'cates'));
    }
    public function postEdit(Request $request, $id)
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
