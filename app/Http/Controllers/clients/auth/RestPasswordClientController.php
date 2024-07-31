<?php

namespace App\Http\Controllers\clients\auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;

class RestPasswordClientController extends Controller
{
    protected $redirectTo;

    use ResetsPasswords;

    public function __construct(){
        $this->redirectTo = route('clients.login');
    }

    public function showResetForm(Request $request)
    {
        $title = 'Đổi mật khẩu';
        $token = $request->route()->parameter('token');

        return view('layouts.clients.auth.reset',compact('title'))->with(
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

    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    protected function sendResetResponse(Request $request, $response)
{
    if ($request->wantsJson()) {
        return new JsonResponse(['message' => trans($response)], 200);
    }

    return redirect()->route('clients.login') // Chuyển hướng đến trang đăng nhập dành cho quản trị viên
                         ->with('msg', 'Đổi mật khẩu thành công! Bạn có thể đăng nhập bằng mật khẩu mới');
}


    public function broker()
    {
        return Password::broker('web');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }
}
