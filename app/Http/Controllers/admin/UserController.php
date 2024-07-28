<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Users;
use \App\Models\admin\Groups;
use App\Http\Requests\admin\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request) {
    $title = "Danh sách người dùng";
    $allGroup = Groups::all();
    $search = $request->input('keywords');
    $query = Users::query()->with('Group');
    
    // Bộ lọc theo trạng thái
    if (!empty($request->role)) {
        $role = $request->role;
        $role = ($role == "active") ? 1 : 0;
        $query->where('role', '=', $role);
    }
    
    // Bộ lọc theo nhóm
    if (!empty($request->group_id)) {
        $group_id = $request->group_id;
        $query->where('group_id', '=', $group_id);
    }

    // Bộ lọc tìm kiếm
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('fullname', 'like', '%'.$search.'%')
              ->orWhere('email', 'like', '%'.$search.'%');
        });
    }

    // Phân trang kết quả
    $allUser = $query->orderBy('id','DESC')->paginate(5)->withQueryString();
    if (Auth::guard('admin')->check()) {
        // Lấy thông tin người dùng từ guard 'admin'
        $user = Auth::guard('admin')->user()->fullname;
        return view('layouts.backend.users.lists', compact('title', 'allUser', 'allGroup', 'user'));
    }
    return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
}

    public function add(){
        $title = "Thêm mới người dùng";
        $allGroup = Groups::all();
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user()->fullname;
            return view('layouts.backend.users.add',compact('title','allGroup'));
        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    }

    public function postAdd(UserRequest $request){
        $dataInsert = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'confirm_password' => $request->confirm_password,
            'phone' => $request->phone,
            'address'=> $request->address,
            'role' => $request->role,
            'group_id' => $request->group_id,
            'email_verified_at'=> date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        // dd($dataInsert);
        Users::create($dataInsert);
        return redirect()->route('admin.user.index')->with('msg','Thêm mới người dùng thành công');
    }

    public function edit($id){
        $title = 'Cập nhập người dùng';
        $allGroup = Groups::all();
        $user = Users::find($id);
        if(!$user) {
            return redirect()->route('admin.user.index')->with('msg_warning', 'Người dùng không tồn tại');
        }
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user()->fullname;
            return view('layouts.backend.users.edit', compact('title', 'allGroup', 'user'));
        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    }

    public function postEdit(UserRequest $request,$id){
        $user = Users::find($id);
        if(!$user) {
            return redirect()->route('admin.user.index')->with('msg_warning', 'Sản phẩm không tồn tại');
        }
        if(!empty($request->password)){
            $dataUpdate = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                // 'confirm_password' => $request->confirm_password,
                'phone' => $request->phone,
                'address'=> $request->address,
                'role' => $request->role,
                'group_id' => $request->group_id,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }else{
            $dataUpdate = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                // 'password' => Hash::make($request->password),
                // 'confirm_password' => $request->confirm_password,
                'phone' => $request->phone,
                'address'=> $request->address,
                'role' => 0,
                'group_id' => $request->group_id,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        // dd($dataUpdate);
        Users::postEdit($id,$dataUpdate);
        return back()->with('msg','Cập nhập người dùng thành công');

    }

    public function delete($id) {
        $user = Users::find($id);
    
        if ($user) {
            $blogCount = $user->blogs()->count();
            $commentCount = $user->comment()->count();
            $reviewCount = $user->review()->count();
            if ($blogCount > 0) {
                return redirect()->route('admin.user.index')
                                 ->with('msg_warning', "Không thể xóa người dùng này vì còn $blogCount bài viết đang sử dụng!");
            }

            if ($commentCount > 0) {
                return redirect()->route('admin.user.index')
                                 ->with('msg_warning', "Không thể xóa người dùng này vì còn $commentCount bình luận đang sử dụng!");
            }

            if ($reviewCount > 0) {
                return redirect()->route('admin.user.index')
                                 ->with('msg_warning', "Không thể xóa người dùng này vì còn $reviewCount đánh giá đang sử dụng!");
            }
            
    
            Users::destroy($id);
            return redirect()->route('admin.user.index')->with('msg', "Xóa người dùng thành công");
        }
    
        return redirect()->route('admin.user.index')->with('msg_warning', "Người dùng không tồn tại.");
    }

}
