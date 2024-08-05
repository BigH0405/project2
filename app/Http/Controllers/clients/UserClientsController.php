<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserClientsController extends Controller
{
    public function showProfile()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Trả về view profile với dữ liệu người dùng
        return view('layouts.clients.profile', compact('user'));
    }

    public function updateProfile(Request $request)
{
    // Lấy thông tin người dùng hiện tại
    $user = Auth::user();

    // Validate dữ liệu
    $request->validate([
        'fullname' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'address' => 'required|string|max:255',
        'password' => 'nullable|string|min:8',
    ]);

    // Cập nhật thông tin người dùng
    $user->fullname = $request->fullname;
    $user->phone = $request->phone;
    $user->address = $request->address;

    // Chỉ cập nhật mật khẩu nếu có dữ liệu mới
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Lưu thay đổi vào cơ sở dữ liệu
    $user->save();

    // Trả về trang profile với thông báo thành công
    return redirect()->route('clients.profile')->with('msg', 'Cập nhập thông tin thành công!');
}


}
