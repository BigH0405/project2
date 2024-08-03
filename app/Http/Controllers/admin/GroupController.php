<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Groups;
use App\Http\Requests\admin\GroupRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\Modules;

class GroupController extends Controller
{
    public function index(Request $request){
        $title = "Quản lý nhóm";
        $search = null;
        $search = $request->input('keywords');
        $query = Groups::query()->with('User');

        if ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        $allGroups = $query->orderBy('id','DESC')->paginate(5)->withQueryString();
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user()->fullname;
            return view('layouts.backend.groups.lists',compact('title','allGroups','user'));

        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    }

    public function add(){
        $title = "Thêm mới nhóm";
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user()->fullname;
            return view('layouts.backend.groups.add',compact('title','user'));


        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    }

    public function postAdd(GroupRequest $request){
        $dataInsert = [
            'name' => $request->name,
            'permissions' => $request->name,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        // dd($dataInsert);
        Groups::create($dataInsert);
        return redirect()->route('admin.group.index')->with('msg','Thêm mới nhóm thành công');
    }

    public function edit($id){
        $groupid = Groups::find($id);
        $title = "Cập nhật nhóm";
        if(!$groupid){
            return redirect()->route('admin.group.index')->with('msg_warning','Nhóm không tồn tại');
        }
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user()->fullname;
            return view('layouts.backend.groups.edit',compact('title','groupid','user'));
        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    }

    public function postEdit(Request $request,$id){
        $groupid = Groups::find($id);
        if(!$groupid){
            return redirect()->route('admin.group.index')->with('msg_warning','Nhóm không tồn tại');
        }

        $dataUpdate = [
            'name' => $request->name,
            'permissions' => $request->name,
        ];

        Groups::postEdit($id, $dataUpdate);
        return back()->with('msg','Cập nhập nhóm thành công');
    }

    public function delete($id){
        $groupid = Groups::find($id);

    
        if ($groupid) {
            $groupCount = $groupid->User()->count();
    
            if ($groupCount > 0) {
                return redirect()->route('admin.group.index')
                                 ->with('msg_warning', "Không thể xóa quyền hành này vì còn $groupCount người dùng đang sử dụng!");
            }
    
            Groups::destroy($id);
            return redirect()->route('admin.group.index')->with('msg', "Xóa quyền hành thành công");
        }
    
        return redirect()->route('admin.group.index')->with('msg_warning', "Quyền hành không tồn tại.");
    }

    public function permission(Groups $groups, $id) {
        $group = Groups::findOrFail($id); // Tìm nhóm theo ID
        $module = Modules::all(); // Lấy tất cả các module
        $roleListArr = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
        ];
    
        // Lấy dữ liệu quyền từ nhóm và giải mã JSON
        $roleJson = $group->permissions;
        $roleArr = !empty($roleJson) ? json_decode($roleJson, true) : [];
    
        return view("layouts.backend.groups.permission", compact('group', 'module', 'roleListArr', 'roleArr'));
    }
    

    public function PostPermission(Request $request, $id) {
        // Tìm nhóm theo ID
        $group = Groups::findOrFail($id); // Sử dụng findOrFail để đảm bảo nhóm tồn tại
    
        // Lấy quyền từ request
        $roleArr = $request->input('role', []);
    
        // Chuyển đổi quyền thành JSON
        $roleJson = json_encode($roleArr, JSON_UNESCAPED_UNICODE);
    
        // Cập nhật quyền vào nhóm
        $group->permissions = $roleJson;
        $group->save(); // Lưu các thay đổi
    
        return back()->with('msg', 'Phân quyền thành công');
    }
    
}
