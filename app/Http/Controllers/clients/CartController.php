<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Products;
use App\Models\clients\ProductsCate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    //
    public function index(){
        $cart = session()->get('cart', []);
        $total = 0;
        $subTotal = 0;

        foreach ($cart as $item) {
            if (isset($item['quanlity'])) {
                $subTotal += $item['price'] * $item['quanlity'];
            }
        }

        $shipping = 30000;
        $total = $subTotal + $shipping;
        $nav = ProductsCate::get();

        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user()->fullname;
            return view('layouts.clients.cart', compact('user', 'nav', 'cart', 'subTotal', 'shipping', 'total'));
        }

        return view('layouts.clients.cart', compact('nav', 'cart', 'subTotal', 'shipping', 'total'));
    }

    public function addCraft(Request $request){
        $productID = $request->input('product_id');
        $quanlity = $request->input('quanlity');
    
        $sanPham = Products::findOrFail($productID);
        $cart = session()->get('cart', []);
    
        if (isset($cart[$productID])) {
            $cart[$productID]['quanlity'] += $quanlity;
        } else {
            $cart[$productID] = [
                'name' => $sanPham->name,
                'quanlity' => $quanlity,
                'image' => $sanPham->image,
                'price' => $sanPham->price,
            ];
        }
    
        session()->put('cart', $cart);
        return redirect()->back()->with('msg','Thêm vào giỏ hàng thành công');
    }
    

    public function updateCraft(Request $request){
        // Your code for updating the cart
        $cartNew=$request->input('cart',[]);
        session()->put('cart', $cartNew);
        return redirect()->back();
    }
}
