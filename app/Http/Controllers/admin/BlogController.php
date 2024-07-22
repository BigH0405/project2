<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
}
