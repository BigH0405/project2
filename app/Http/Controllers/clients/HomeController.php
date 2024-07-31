<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
{
    // Kiểm tra nếu người dùng đã đăng nhập bằng guard 'web'
    if (Auth::guard('web')->check()) {
        // Lấy thông tin người dùng từ guard 'web'
        $user = Auth::guard('web')->user()->fullname;
        return view('layouts.clients.clients', compact('user'));
    }

    return view('layouts.clients.clients');
}

}
