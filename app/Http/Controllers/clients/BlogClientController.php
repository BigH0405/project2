<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\admin\BlogCategory;
use App\Models\admin\Comments;
use App\Models\clients\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogClientController extends Controller
{
    public function index(Request $request){
        $messege=Comments::count();
        $search = null;
        $search = $request->input('keywords');
        $query = Blogs::query();
        if ($search) {
            $query->where('title', 'like', '%'.$search.'%');
            }
        $allBlogs = $query->orderBy('id','DESC')->paginate(5)->withQueryString();
        $allTop = $query->orderBy('views','DESC')->paginate(4)->withQueryString();
        if (Auth::guard('web')->check()) {
            // Lấy thông tin người dùng từ guard 'web'
            $user = Auth::guard('web')->user()->fullname;
            return view('layouts.clients.blog',compact('allBlogs','messege','allTop','user'));
        }
        // Chuyển hướng tới trang đăng nhập với thông báo cảnh báo
        return view('layouts.clients.blog',compact('allBlogs','messege','allTop'));
}
}