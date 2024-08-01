<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\ContactRequest;
use App\Models\clients\Contacts;
use Illuminate\Http\Request;

class ContactClientController extends Controller
{
    public function index(){
        return view('layouts.clients.contact');
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
