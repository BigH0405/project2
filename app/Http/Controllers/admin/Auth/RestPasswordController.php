<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;

class RestPasswordController extends Controller
{
    protected $redirectTo = '/admin/login';

    use ResetsPasswords;

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('layouts.backend.auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    
    protected function validationErrorMessages()
    {
        return [
            'token.required' => 'Token không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.confirmed' => 'Mật khẩu xác nhận không trùng khớp',
        ];
    }

    public function broker()
    {
        return Password::broker('admin');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
