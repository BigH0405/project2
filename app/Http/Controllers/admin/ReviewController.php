<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ReviewRequest;
use App\Models\admin\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request){
        $title="Đánh giá ";
        $search = null;
        $search = $request->input('keywords');
        $query=Reviews::query();
        if ($search) {
            // Nếu có từ khóa tìm kiếm, thêm điều kiện join và where để lọc Đánh giá theo name trong bảng product
            $query->whereHas('product', function($q) use ($search){
            $q->where('name', 'like', '%'.$search.'%');
            });
        }
        $allReviews= $query->orderBy('id','DESC')->paginate(10)->withQueryString();
        if (Auth::guard('admin')->check()) {
            // Lấy thông tin người dùng từ guard 'admin'
            $user = Auth::guard('admin')->user()->fullname;
            return view('layouts.backend.reviews.lists',compact('title','allReviews','user'));
        }
        return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
        }
        public function edit($id){
            $title = "Cập nhập Đánh giá";
            $reviews =  Reviews::find($id);
    
            if(!$reviews) {
                return redirect()->route('admin.reviews.index')->with('msg_warning', 'Đánh giá không tồn tại');
            }
            if (Auth::guard('admin')->check()) {
                // Lấy thông tin người dùng từ guard 'admin'
                $user = Auth::guard('admin')->user()->fullname;
                return view('layouts.backend.reviews.edit',compact('title','reviews','user'));
            }
            return redirect()->route('admin.login')->with('msg_warning', 'Bạn cần đăng nhập để thực hiện các thao tác khác');
    
        }
        public function postEdit(ReviewRequest $request, $id){
            $contact = Reviews::find($id);
        
            if (!$contact) {
                return redirect()->route('admin.reviews.index')->with('msg_warning', 'Đánh giá không tồn tại');
            }    
            $dataUpdate = [
                'messege' => $request->messege,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        
            Reviews::where('id', $id)->update($dataUpdate);
        
            return back()->with('msg', "Sửa đánh giá thành công");
        }
        public function delete($id){
            $Reviews = Reviews::find($id);
            if($Reviews){
                Reviews::destroy($id);
                return redirect()->route('admin.reviews.index')->with('msg',"Xóa đánh giá thành công");
            }
            return redirect()->route('admin.reviews.index')->with('msg_warning',"Đánh giá không tồn tại");
        }
}
