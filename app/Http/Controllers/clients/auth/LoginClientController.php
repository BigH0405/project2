<?php

namespace App\Http\Controllers\clients\auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginClientController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function login()
    {
        return view('layouts.clients.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validateLogin($request);
        $request->validate([
            $this->username() => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ],
        [
            $this->username().'.required'=> 'Email bắt buộc phải nhập',
            $this->username().'.string'=> 'Email không hợp lệ',
            $this->username().'.email'=> 'Email không đúng định dạng',
            $this->username().'.unique'=> 'Email không có trong hệ thống',
            'password.required'=> 'Mật khẩu bắt buộc phải nhập',
            'password.string'=> 'Kiểu dữ liệu mật khẩu không hợp lệ',
            'password.min'=> 'Mật khẩu phải từ :min ký tự',
        ]
        );
        $credentials = $request->only('email', 'password');

        if (isClients($credentials['email'])) {
            if (Auth::guard('web')->attempt($credentials)) {
                return redirect()->intended(RouteServiceProvider::HOME);
            } else {
                return back()->with('msg_warning', 'Email hoặc mật khẩu không hợp lệ');
            }
        } else {
            return back()->with('msg_warning', 'Tài khoản không có trong hệ thống');
        }
    }
}
