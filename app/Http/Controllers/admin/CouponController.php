<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CouponRequest;
use App\Models\admin\Coupons;
use App\Models\admin\Users;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(Request $request){
        $title ="Mã giảm giá";
        $query = Coupons::query()->with('Users');

        $search = null;
        $search = $request->input('keywords');
        if ($search) {
            $query->where('code', 'like', '%'.$search.'%');
        }

        $allCoupon= $query->paginate(5)->withQueryString();
        return view('layouts.backend.coupons.lists',compact('title','allCoupon'));
    }
    public function add(){
        $title ="Thêm mã giảm giá";
        $allUser=Users::all();
        return view('layouts.backend.coupons.add',compact('title','allUser'));
    }
    public function postAdd(CouponRequest $request){
        $dataInsert=[
            'code'=>$request->code,
            'user_id'=>$request->user_id,
            'discount'=>$request->discount,
            'quantily'=>$request->quantily,
            'start_day'=>$request->start_day,
            'end_day'=>$request->end_day,
            'create_at'=>date('Y-m-d H:i:s')
        ];
        Coupons::create($dataInsert);
        return redirect()->route('admin.coupons.index')->with('msg',"Thêm danh mục thành công");   

    }
    
    public function edit($id){
        $title ="Cập nhật mã giảm giá";
        $CouponDetail = Coupons::find($id);
        if(!$CouponDetail) {
            return redirect()->route('admin.coupons.index')->with('msg_warning', 'Mã giảm giá không tồn tại');
        }
        $allUser=Users::all();
        return view('layouts.backend.coupons.edit',compact('title','allUser','CouponDetail'));
    }
    public function postEdit(CouponRequest $request, $id){
        $coupons = Coupons::find($id);

        if(!$coupons) {
            return redirect()->route('admin.coupons.index')->with('msg_warning', 'Mã giảm giá không tồn tại');
        }

        $dataUpdate = [
            'code'=>$request->code,
            'user_id'=>$request->user_id,
            'discount'=>$request->discount,
            'quantily'=>$request->quantily,
            'start_day'=>$request->start_day,
            'end_day'=>$request->end_day,
            'updated_at' => date('Y-m-d H:i:s') 
        ];

        Coupons::postEdit($id, $dataUpdate);

        return back()->with('msg', "Sửa mã giảm giá thành công");
    }
    public function delete($id){
        $coupons= Coupons::find($id);

        if($coupons){
            Coupons::destroy($id);
            return redirect()->route('admin.coupons.index')->with('msg', "Xóa sản phẩm thành công");
        }
        return redirect()->route('admin.coupons.index')->with('msg_warning', "Sản phẩm không tồn tại.");
    
    }

}
