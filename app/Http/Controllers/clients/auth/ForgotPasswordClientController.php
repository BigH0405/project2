<?php

namespace App\Http\Controllers\clients\auth;

use App\Http\Controllers\Controller;
use App\Models\clients\ProductsCate;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordClientController extends Controller
{
    use SendsPasswordResetEmails;
    public function getForgotPassword(){
        $nav = ProductsCate::get();
        $title = 'Quên mật khẩu';
        return view('layouts.clients.auth.forgot',compact('title','nav'));
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email'
            ],
            [
                'email.required'=>'Email bắt buộc phải nhập',
                'email.email' => 'Email không đúng định dạng'
            ]
        );
        $credentials = $request->only('email');
        if (!isClients($credentials['email'])) {
            return back()->with('msg_warning', 'Tài khoản không có trong hệ thống');        
        }
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $request->wantsJson()
                    ? new JsonResponse(['message' => trans($response)], 200)
                    : back()->with('msg', 'Một đường dẫn liên kết đã được gửi tới email của bạn');
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [trans($response)],
            ]);
        }

        return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Hệ thống xảy ra lỗi! Hay đợi mấy phút rồi thử lại!']);
    }

    public function broker()
    {
        return Password::broker('');
    }
}
