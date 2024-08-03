<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\ProductsCate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function index(){
        $nav = ProductsCate::get();
        if (Auth::guard('web')->check()) {
            // Lấy thông tin người dùng từ guard 'web'
            $user = Auth::guard('web')->user()->fullname;
            return view('layouts.clients.blog',compact('user','nav'));
        }
        return view('layouts.clients.cart',compact('nav'));

    }
}
