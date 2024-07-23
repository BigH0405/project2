<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\BlogRequest;
use Illuminate\Http\Request;
use App\Models\admin\Blog;

class BlogController extends Controller
{
    //
    public function index(){
        $title = "Danh sách bài viết";
        $allBlog = Blog::all();
        return view('layouts.backend.blogs.lists',compact('title','allBlog'));
    }

    public function add(){
        $title = 'Thêm mới bài viết';
        return view('layouts.backend.blogs.add',compact('title'));
    }

    public function postAdd(BlogRequest $request){
        $dataInsert = [
            'title'=> $request->title,
            'image'=> $request->image,
            'views'=> $request->views,
            'user_id'=> $request->user_id,
            'blog_id'=> $request->blog_id,
            ''
        ];
    }
}
