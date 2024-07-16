<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ProductRequest;
use App\Models\admin\ProductCategory;
use App\Models\admin\Promotions;
use Illuminate\Http\Request;
use App\Models\admin\Products;

class ProductController extends Controller
{
    public function index(Request $request){
        $title = "Sản phẩm";
        $allCate = ProductCategory::all();
        $allPromo = Promotions::all();
        $search = null;
        $search = $request->input('keywords');
        $query = Products::query();
        if (!empty($request->product_category)) {
            $product_category = $request->product_category;
            $query->where('product_category', '=', $product_category);
        }
        if (!empty($request->price_sale)) {
            $price_sale = $request->price_sale;
            $query->where('price_sale', '=', $price_sale);
        }
        if ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        $allProduct = $query->paginate(5)->withQueryString();
        return view('layouts.backend.products.lists',compact('title','allProduct','allCate','allPromo'));
    }
    public function add(){
        $allCate = ProductCategory::all();
        $allPromo = Promotions::all();
        $title = "Thêm mới sản phẩm";
        return view('layouts.backend.products.add',compact('title','allCate','allPromo'));
        
    }
    public function postAdd(ProductRequest $request ){
        $dataInsert = [
            'name' => $request->name,
            'price' => $request->price,
            'price_sale' => $request->price_sale,
            'image' => $request->image,
            'product_category' => $request->product_category,
            'quantity' => $request->quantity,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'create_at'=>date('Y-m-d H:i:s')
        ];
        Products::create($dataInsert);
        return redirect()->route('admin.product.index')->with('msg',"Thêm sản phẩm thành công");   
    }
    public function edit($id){
        $title = "Cập nhập sản phẩm";
        $allCate = ProductCategory::all();
        $allPromo = Promotions::all();
        $product =  Products::find($id);
        if(!$product) {
            return redirect()->route('admin.products.index')->with('msg_warning', 'Sản phẩm không tồn tại');
        }
        return view('layouts.backend.products.edit',compact('title','product','allPromo','allCate'));
    }
    public function postEdit(ProductRequest $request, $id){
        $product = Products::find($id);

        if(!$product) {
            return redirect()->route('admin.product.index')->with('msg_warning', 'Sản phẩm không tồn tại');
        }

        $dataUpdate = [
            'name' => $request->name,
            'price' => $request->price,
            'price_sale' => $request->price_sale,
            'image' => $request->image,
            'product_category' => $request->product_category,
            'quantity' => $request->quantity,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'update_at' => date('Y-m-d H:i:s') 
        ];

        Products::postEdit($id, $dataUpdate);

        return back()->with('msg', "Sửa sản phẩm thành công");
    }
    public function delete($id){
        $product= Products::find($id);
        if($product){
            Products::destroy($id);
            return redirect()->route('admin.product.index')->with('msg', "Xóa sản phẩm thành công");
        }
        return redirect()->route('admin.product.index')->with('msg_warning', "Sản phẩm không tồn tại.");
    
    }
}
