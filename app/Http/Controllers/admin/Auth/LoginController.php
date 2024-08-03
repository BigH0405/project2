<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::ADMIN;

    public function login()
    {
        return view('layouts.backend.auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|email',
            'password' => 'required|string|min:8',
        ],
        [
            $this->username().'.required'=> 'Email bắt buộc phải nhập',
            $this->username().'.string'=> 'Email không hợp lệ',
            $this->username().'.email'=> 'Email không đúng định dạng',
            'password.required'=> 'Mật khẩu bắt buộc phải nhập',
            'password.string'=> 'Kiểu dữ liệu mật khẩu không hợp lệ',
            'password.min'=> 'Mật khẩu phải từ :min ký tự',
        ]
        );

        $credentials = $request->only('email', 'password');

        if (isAdmin($credentials['email'])) {
            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('admin.index');
            } else {
                return back()->with('msg_warning', 'Email hoặc mật khẩu không hợp lệ');
            }
        } else {
            return back()->with('msg_warning', 'Tài khoản không phải là quản trị viên');
        }
    }

    public function logout(Request $request)
    {
        // $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('clients/');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
