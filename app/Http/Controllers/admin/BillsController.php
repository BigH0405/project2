<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillsController extends Controller
{
    public function index()
    {
        $bills = Bill::with('orderDetails')->get();
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user();
            return view('layouts.backend.bills.index', compact('bills'));
        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    }

    public function updateStatus(Request $request, $id)
    {
        $bill = Bill::find($id);

        if (!$bill) {
            return redirect()->route('admin.bills.index')->with('error', 'Bill not found');
        }

        $currentStatus = session("bill_status_{$id}", 'Chờ xác nhận');

        // Xác định trạng thái tiếp theo
        $statusList = ['Chờ xác nhận', 'Đang đóng đồ', 'Đang giao', 'Giao thành công'];
        $currentIndex = array_search($currentStatus, $statusList);
        $nextIndex = ($currentIndex + 1) % count($statusList);
        $nextStatus = $statusList[$nextIndex];

        // Lưu trạng thái tiếp theo vào phiên làm việc
        session()->put("bill_status_{$id}", $nextStatus);

        return redirect()->route('admin.bills.index')->with('msg', 'Chuyển đổi trạng thái thành công');
    }

    public function edit($id)
    {
        $title = "Cập nhật đơn hàng";
        $bills = Bill::find($id);
        if (!$bills) {
            return redirect()->route('admin.bills.index')->with('msg_warning', 'Danh mục bài viết không tồn tại');
        }
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user();
            return view('layouts.backend.bills.edit', compact('title', 'bills','user'));

        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    }
    public function postEdit(Request $request, $id)
    {
        $bills = Bill::find($id);

        if (!$bills) {
            return redirect()->route('admin.bills.index')->with('msg_warning', 'Danh mục bài viết không tồn tại');
        }
        $dataUpdate = [
            'code' => $request->code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'price' => $request->price,
            'messege' => $request->messege,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        // dd($dataUpdate);
        // die;
        // BlogCategory::postEdit($id, $dataUpdate);
        $blogCategory = new Bill();
        $blogCategory->postEdit($id, $dataUpdate);
        return back()->with('msg', "Sửa danh mục thành công");
    }



    public function delete($id)
    {
        $cates = Bill::find($id);
        if($cates){
            Bill::destroy($id);
            return redirect()->route('admin.bills.index')->with('msg', "Xóa danh mục bài viết thành công");
        }
        return redirect()->route('admin.bills.index')->with('msg_warning', "Danh mục bài viết không tồn tại");
       
    }
}
