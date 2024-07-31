<?php

namespace App\Http\Controllers\clients\auth;

use App\Http\Controllers\Controller;
use App\Models\clients\Users;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers, VerifiesEmails, RedirectsUsers;
    
    protected $redirectTo;


    public function __construct()
    {
        $this->middleware('guest');
        $this->redirectTo = route('clients.register');
    }

    public function showRegistrationForm()
    {
        $title = 'Đăng ký tài khoản';
        return view('layouts.clients.auth.register',compact('title'));

    }

protected function validator(array $data)
{
    return Validator::make($data, [
        'fullname' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
        'password_confirmation' => ['required', 'same:password'],
        'address' => ['required', 'string'],
        'phone' => ['required', 'string', 'regex:/^0\d{9,11}$/'],
    ], [
        'fullname.required' => 'Tên không được để trống',
        'fullname.string' => 'Tên phải là ký tự',
        'fullname.max' => 'Tên phải nhỏ hơn :max ký tự',
        'email.required' => 'Email không được để trống',
        'email.string' => 'Email phải là ký tự',
        'email.email' => 'Email không đúng định dạng',
        'email.max' => 'Email phải nhỏ hơn :max ký tự',
        'email.unique' => 'Email đã tồn tại trên hệ thống',
        'password.required' => 'Mật khẩu không được để trống',
        'password.string' => 'Mật khẩu phải là ký tự',
        'password.min' => 'Mật khẩu phải lớn hơn :min ký tự',
        'password.confirmed' => 'Mật khẩu xác nhận không đúng',
        'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu',
        'password_confirmation.same' => 'Mật khẩu xác nhận phải trùng với mật khẩu',
        'address.required' => 'Địa chỉ không được để trống',
        'address.string' => 'Địa chỉ phải là ký tự',
        'phone.required' => 'Số điện thoại không được để trống',
        'phone.string' => 'Số điện thoại phải là ký tự',
        'phone.regex' => 'Số điện thoại không đúng định dạng',
    ]);
}

protected function create(array $data)
{
    $user = Users::create([
        'fullname' => $data['fullname'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'address' => $data['address'],
        'phone' => $data['phone'],
    ]);
    // Gửi email xác minh
    $user->sendEmailVerificationNotification();
    
    return $user;
}

public function register(Request $request)
{
    $this->validator($request->all())->validate();

    event(new Registered($user = $this->create($request->all())));

    // Gửi email xác minh
    try {
        $user->sendEmailVerificationNotification();
    } catch (\Exception $e) {
        return redirect()->back()->with('msg_danger', 'Không thể gửi email xác minh. Vui lòng thử lại.');
    }

    // $this->guard()->login($user);

    if ($response = $this->registered($request, $user)) {
        return $response;
    }

    return $request->wantsJson()
        ? new JsonResponse([], 201)
        : redirect()->route('clients.register')->with('msg', 'Đăng ký thành công! Vui lòng kiểm tra email để xác minh tài khoản.');
}


}
