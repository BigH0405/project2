<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\BillRequest;
use App\Models\clients\Bills;
use App\Models\clients\orders_detail;
use App\Models\clients\ProductsCate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BillController extends Controller
{
    public function index(){

        $donHangs=Auth::user()->donHang;
        $nav = ProductsCate::get();
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            return view('layouts.clients.bill_detail', compact('user', 'nav','donHangs'));
        }
        return view('layouts.clients.bill_detail', compact('nav','donHangs'));
    }

    public function create(){
        $cart = session()->get('cart', []);
        $total = 0;
        $subTotal = 0;

        if (!empty($cart)) {
            foreach ($cart as $item) {
                $subTotal += $item['price'] * $item['quanlity'];
            }
            $shipping = 30000;
            $total = $subTotal + $shipping;
        }

        $nav = ProductsCate::get();
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            return view('layouts.clients.checkout', compact('user', 'nav', 'subTotal', 'shipping', 'total', 'cart'));
        }
        return redirect()->route('clients.lists')->with('msg','Đăng nhập để tiếp tục');
    }
    function generateUniqueOrderCode(){
        do {
            $orderCode = 'ORD' . Auth::id() . '-' . now()->timestamp;
        } while (Bills::where('code', $orderCode)->exists());

        return $orderCode;
    }

    public function store(BillRequest $request)
    {
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            // try {
                // Lấy thông tin từ request và thêm code đơn hàng
                $params = $request->except('_token');
                $params['code'] = $this->generateUniqueOrderCode();
                $params['user_id'] = Auth::id(); // Thêm user_id
        
                // Lưu giỏ hàng vào mảng
                $cart = session()->get('cart', []);
                $params['products'] = json_encode($cart); // Lưu giỏ hàng dưới dạng JSON
        
                // Tạo đơn hàng mới
                $bill = Bills::create($params);
        
                // Lưu chi tiết đơn hàng
                foreach ($cart as $productId => $item) {
                    // Kiểm tra dữ liệu giỏ hàng
                    if (!isset($item['quanlity']) || !isset($item['price'])) {
                        throw new \Exception("Thiếu thông tin quantity hoặc price cho sản phẩm ID: $productId");
                    }
        
                    orders_detail::create([
                        'bill_id' => $bill->id,
                        'product_id' => $productId,
                        'quanlity' => $item['quanlity'], // Đảm bảo thuộc tính đúng là 'quantity'
                        'price' => $item['price'],
                    ]);
                }
        
                // Xóa giỏ hàng
                session()->put('cart', []);
                DB::commit();
        
                return redirect()->route('clients.cart');
            } 
            // catch (\Exception $e) {
            //     DB::rollBack();
            //     return redirect()->route('clients.cart')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            // }
        }
    
    

    
    public function show(string $id){
        $donHang=Bills::query()->findOrFail($id);
        // $donHang = Bills::with('chiTietDonHang.sanPham')->findOrFail($id);
        $nav = ProductsCate::get();
        if (Auth::guard('web')->check()) {
            // Lấy thông tin người dùng từ guard 'web'
            $user = Auth::guard('web')->user();
            return view('layouts.clients.showBill',compact('user','nav','donHang'));
        }

        return redirect()->route('clients.lists')->with('msg','Đăng nhập để tiếp tục');
    }
}    
    
    


