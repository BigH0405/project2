<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\BlogCategory;
use App\Http\Requests\admin\BlogCategoryRequest;


class BlogCategoryController extends Controller
{
    //
    public function index(Request $request){
        $title = "Danh sách bài viết";

        $allCate = BlogCategory::query()->paginate(5)->withQueryString();

        return view('layouts.backend.blog_category.lists',compact('title','allCate'));

    }
    public function add(){
        $title = "Thêm mới danh sách bài viết";

        return view('layouts.backend.blog_category.add',compact('title'));

    }
    public function postAdd(Request $request){
        $dataIntert = [
            'name' => $request->name,
            'short_description' => $request->short_description,
            'created_at' => date('Y-m-d H:i:s')
        ];
        // dd($dataIntert);
        BlogCategory::create($dataIntert);
        return redirect()->route('admin.cates.index')->with('msg',"Thêm danh mục bài viết thành công");
    }
}
