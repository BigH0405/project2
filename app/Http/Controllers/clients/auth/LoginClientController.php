<?php

namespace App\Http\Controllers\clients\auth;

use App\Http\Controllers\Controller;
use App\Models\clients\ProductsCate;
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
        $nav = ProductsCate::get();
        $title = "Đăng nhập";
        return view('layouts.clients.auth.login',compact('title','nav'));
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|email|exists:users,email',
            'password' => 'required|string',
        ],
        [
            $this->username().'.required'=> 'Email bắt buộc phải nhập',
            $this->username().'.string'=> 'Email không hợp lệ',
            $this->username().'.email'=> 'Email không đúng định dạng',
            $this->username().'.exists'=> 'Email không có trong hệ thống',
            'password.required'=> 'Mật khẩu bắt buộc phải nhập',
            'password.string'=> 'Kiểu dữ liệu mật khẩu không hợp lệ',
        ]
        );
        $credentials = $request->only('email', 'password');

        if (isClients($credentials['email'])) {
            if (Auth::guard('web')->attempt($credentials)) {
                return redirect()->route('clients.lists');
            } else {
                return back()->with('msg_warning', 'Email hoặc mật khẩu không đúng');
            }
        } else {
            return back()->with('msg_warning', 'Email hoặc mật khẩu không hợp lệ');
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
            : redirect('/');
    }
}
