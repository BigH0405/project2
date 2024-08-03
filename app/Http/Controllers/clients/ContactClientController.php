<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\ContactRequest;
use App\Models\clients\Contacts;
use App\Models\clients\ProductsCate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactClientController extends Controller
{
    public function index(){
        $nav = ProductsCate::get();

        if (Auth::guard('web')->check()) {
            // Lấy thông tin người dùng từ guard 'web'
            $user = Auth::guard('web')->user()->fullname;
            return view('layouts.clients.contact',compact('user','nav'));
        }
        // Chuyển hướng tới trang đăng nhập với thông báo cảnh báo
        return view('layouts.clients.contact',compact('nav'));
    }
    public function postContacts(ContactRequest $request){
        $dataInsert = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        // dd($dataInsert);
        // return('hai vai');
    Contacts::create($dataInsert);
    return back()->with('msg', "Liên hệ đã được gửi thành công");
    }
}
