<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Promotions;
use App\Http\Requests\admin\PromotionsRequest;
use Carbon\Carbon;

class PromotionController extends Controller
{
    public function index(Request $request){
        $title = 'Danh sách mã giảm giá';
        $query = Promotions::query();
    
        // Lấy status từ request và áp dụng bộ lọc nếu không rỗng và không phải là "0"
        if (!empty($request->status)) {
            $status = $request->status == 'active' ? 1 : 0;
            $query->where('status', '=', $status);
        }
    
        // Lấy keyword từ request và áp dụng tìm kiếm nếu không rỗng
        $keyword = $request->input('keywords');
        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    
        // Lấy tất cả kết quả đã được lọc
        $allCoupon = $query->paginate(3)->withQueryString();
    
        return view('layouts.backend.promotions.lists', compact('title', 'allCoupon'));
    }

    public function add(){
        $title = 'Thêm mới mã giảm giá';

        return view('layouts.backend.promotions.add', compact('title'));
        
    }

    public function postAdd(PromotionsRequest $request){
        $dataInsert = [
            'name' => $request->name,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'start_day' => $request->start_day,
            'end_day' => $request->end_day,
            'status' => $request->status,
            'create_at' => date('Y-m-d H:i:s') 
        ];

        Promotions::create($dataInsert);
        return redirect()->route('admin.sale.index')->with('msg',"Thêm mã giảm giá thành công");
    }

    public function edit($id){
        $title = 'Cập nhập mã giảm giá';
        $saleDetails = Promotions::find($id);
        if(!$saleDetails){
            return redirect()->route('admin.sale.index')->with('msg_warning','Mã giảm giá không tồn tại');
        }
        $saleDetails->start_day = $saleDetails->start_day 
        ? Carbon::parse($saleDetails->start_day)->format('Y-m-d') 
        : null;

    // Tương tự cho end_day nếu cần
    $saleDetails->end_day = $saleDetails->end_day 
        ? Carbon::parse($saleDetails->end_day)->format('Y-m-d') 
        : null;
        return view('layouts.backend.promotions.edit', compact('title','saleDetails'));
    }

    public function postEdit(PromotionsRequest $request, $id){
        $saleDetails = Promotions::find($id);

        if(!$saleDetails){
            return redirect()->route('admin.sale.index')->with('msg_warning','Mã giảm giá không tồn tại');
        }

        $dataUpdate = [
            'name' => $request->name,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'start_day' => $request->start_day,
            'end_day' => $request->end_day,
            'status' => $request->status,
            'update_at' => date('Y-m-d H:i:s') 
        ];

        Promotions::postEdit($id,$dataUpdate);
        return back()->with('msg','Cập nhập mã giảm giá thành công');
    }

    public function delete($id){
        $saleDetails = Promotions::find($id);
    
        if ($saleDetails) {
            // Đếm số sản phẩm liên quan đến danh mục sản phẩm
            $productCount = $saleDetails->products()->count();
    
            // Kiểm tra nếu có sản phẩm liên quan
            if ($productCount > 0) {
                // Hiển thị thông báo lỗi và trả về trang danh mục sản phẩm
                return redirect()->route('admin.sale.index')
                                 ->with('msg_warning', "Không thể xóa mã này vì còn $productCount sản phẩm đang sử dụng!");
            }
    
            // Tiến hành xóa danh mục sản phẩm
            Promotions::destroy($id);
            return redirect()->route('admin.sale.index')->with('msg', "Xóa mã giảm giá thành công");
        }
    
        return redirect()->route('admin.sale.index')->with('msg_warning', "Mã giảm giá không tồn tại.");
    }
}
