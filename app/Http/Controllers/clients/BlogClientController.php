<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\admin\BlogCategory;
use App\Models\admin\Comments;
use App\Models\clients\BlogCate;
use App\Models\clients\Blogs;
use App\Models\clients\ProductsCate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogClientController extends Controller
{
    public function index(Request $request){
        $nav = ProductsCate::get();
        $messege=Comments::count();
        $search = null;
        $search = $request->input('keywords');
        $query = Blogs::query();
        $top = Blogs::query();
        if ($search) {
            $query->where('title', 'like', '%'.$search.'%');
            }
        $allBlogs = $query->orderBy('id','DESC')->paginate(5)->withQueryString();
        $allTop = $top->orderBy('views','DESC')->paginate(4)->withQueryString();
        $allCate = BlogCate::orderBy("id", "desc")->limit(1)->get();

        if (Auth::guard('web')->check()) {
            // Lấy thông tin người dùng từ guard 'web'
            $user = Auth::guard('web')->user();
            return view('layouts.clients.blog',compact('allBlogs','messege','allTop','allCate','user','nav'));
        }
        // Chuyển hướng tới trang đăng nhập với thông báo cảnh báo
        return view('layouts.clients.blog',compact('allBlogs','messege','allTop','allCate','nav'));
}

    public function showDetail(Request $request,$id){
        $title = 'Chi tiết bài viết';
        $blog = Blogs::find($id);
        $allBlog = Blogs::all();
        $nav = ProductsCate::get();
        $messege=Comments::count();
        $search = null;
        $search = $request->input('keywords');
        $query = Blogs::query();
        $top = Blogs::query();
        if ($search) {
            $query->where('title', 'like', '%'.$search.'%');
            }
        $allBlogs = $query->orderBy('id','DESC')->limit(1)->get();
        $allTop = $top->orderBy('views','DESC')->paginate(4)->withQueryString();
        $allCate = BlogCate::orderBy("id", "desc")->limit(1)->get();
        if (!$blog) {
            return redirect()->route('layouts.clients.blog_detail', ['id' => $id])->with('msg_warning', 'Bài viết không tồn tại');
        }

        if (Auth::guard('web')->check()) {
            // Lấy thông tin người dùng từ guard 'web'
            $user = Auth::guard('web')->user();
            return view('layouts.clients.blog_detail', compact('user','title','blog','allBlogs','messege','allTop','allCate','nav'));
        }
    
        return view('layouts.clients.blog_detail', compact('title','blog','allBlogs','messege','allTop','allCate','nav'));
    }
}