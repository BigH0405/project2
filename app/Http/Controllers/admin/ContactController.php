<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ContactRequest;
use App\Models\admin\Contacts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //
    public function index(Request $request){
        $title="Liên hệ";
        $search = null;
        $search = $request->input('keywords');
        $query=Contacts::query();
        if ($search) {
            $query->where('fullname', 'like', '%'.$search.'%');
        }
        $allContacts = $query->orderBy('id','DESC')->paginate(5)->withQueryString();
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user()->fullname;
            return view('layouts.backend.contacts.lists',compact('title','allContacts','user'));
        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    }
    public function edit($id){
        $title = "Cập nhập liên hệ";
        $contacts =  Contacts::find($id);
        $allUser = User::all();

        if(!$contacts) {
            return redirect()->route('admin.contacts.index')->with('msg_warning', 'Liên hệ không tồn tại');
        }
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user()->fullname;
            return view('layouts.backend.contacts.edit',compact('title','contacts','allUser','user'));
        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');

    }
    public function postEdit(ContactRequest $request, $id){
        $contact = Contacts::find($id);
    
        if (!$contact) {
            return redirect()->route('admin.contacts.index')->with('msg_warning', 'Liên hệ không tồn tại');
        }    
        $dataUpdate = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'user_id' => $request->user_id,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    
        Contacts::where('id', $id)->update($dataUpdate);
    
        return back()->with('msg', "Sửa liên hệ thành công");
    }
    public function delete($id){
        $contact= Contacts::find($id);
        if($contact){
            Contacts::destroy($id);
            return redirect()->route('admin.contacts.index')->with('msg', "Xóa liên hệ thành công");
        }
        return redirect()->route('admin.contacts.index')->with('msg_warning', "Liên hệ không tồn tại.");
    
    }
}
