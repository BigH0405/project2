<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ContactRequest;
use App\Models\admin\Contacts;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('layouts.backend.contacts.lists',compact('title','allContacts'));
    }
    public function edit($id){
        $title = "Cập nhập liên hệ";
        $contacts =  Contacts::find($id);
        $allUser = User::all();

        if(!$contacts) {
            return redirect()->route('admin.contacts.index')->with('msg_warning', 'Liên hệ không tồn tại');
        }
        // dd($contacts);

        return view('layouts.backend.contacts.edit',compact('title','contacts','allUser'));
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
