<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CommentRequest;
use App\Models\admin\Comments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    //
    public function index(Request $request){
    $title="Bình luận";
    $search = null;
    $search = $request->input('keywords');
    $query=Comments::query();
    if ($search) {
        // Nếu có từ khóa tìm kiếm, thêm điều kiện join và where để lọc bình luận theo fullname trong bảng users
        $query->whereHas('user', function($q) use ($search){
        $q->where('fullname', 'like', '%'.$search.'%');
        });
    }
    $allComments= $query->orderBy('id','DESC')->paginate(10)->withQueryString();
    return view('layouts.backend.comments.lists',compact('title','allComments'));
    }
    public function edit($id){
        $title = "Cập nhập bình luận";
        $comments =  Comments::find($id);

        if(!$comments) {
            return redirect()->route('admin.comments.index')->with('msg_warning', 'Liên hệ không tồn tại');
        }
        // dd($comments);

        return view('layouts.backend.comments.edit',compact('title','comments'));
    }
    public function delete($id){
        $Comments = Comments::find($id);
        if($Comments){
            Comments::destroy($id);
            return redirect()->route('admin.comments.index')->with('msg',"Xóa bình luận thành công");
        }
        return redirect()->route('admin.comments.index')->with('msg_warning',"Bình luận không tồn tại");
    }
    public function postEdit(CommentRequest $request, $id){
        $contact = Comments::find($id);
    
        if (!$contact) {
            return redirect()->route('admin.comments.index')->with('msg_warning', 'Bình luận không tồn tại');
        }    
        $dataUpdate = [
            'messege' => $request->messege,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    
        Comments::where('id', $id)->update($dataUpdate);
    
        return back()->with('msg', "Sửa bình luận thành công");
    }
}
