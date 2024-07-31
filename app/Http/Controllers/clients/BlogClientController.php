<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogClientController extends Controller
{
    public function index(){
        if (Auth::guard('web')->check()) {
            // Lấy thông tin người dùng từ guard 'web'
            $user = Auth::guard('web')->user()->fullname;
            return view('layouts.clients.blog',compact('user'));
        }
        // Chuyển hướng tới trang đăng nhập với thông báo cảnh báo
        return view('layouts.clients.blog');
    }
}
