<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ProductRequest;
use App\Models\admin\ProductCategory;
use Illuminate\Http\Request;
use App\Models\admin\Products;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $request){
        $title = "Sản phẩm";
        $allCate = ProductCategory::all();
        $search = null;
        $search = $request->input('keywords');
        $query = Products::query()->with('productCate');
        if (!empty($request->product_category)) {
            $product_category = $request->product_category;
            $query->where('product_category', '=', $product_category);
        }

        if ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        $allProduct = $query->orderBy('id','DESC')->paginate(5)->withQueryString();
        return view('layouts.backend.products.lists',compact('title','allProduct','allCate'));
    }
    public function add(){
        $allCate = ProductCategory::all();
        $title = "Thêm mới sản phẩm";
        return view('layouts.backend.products.add',compact('title','allCate'));
        
    }
    public function postAdd(ProductRequest $request ){

        if($request->has('image')){

            $file =$request->file('image');
            $extension=$file->getClientOriginalExtension();

            $filename= time().'.'.$extension;

            $path='backend/uploads/products/';
            $file->move($path,$filename);
        }
        $dataInsert = [
            'name' => $request->name,
            'price' => $request->price,
            'image' => $path.$filename,
            'product_category' => $request->product_category,
            'quanlity' => $request->quanlity,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        Products::create($dataInsert);
        return redirect()->route('admin.product.index')->with('msg',"Thêm sản phẩm thành công");   
    }
    public function edit($id){
        $title = "Cập nhập sản phẩm";
        $allCate = ProductCategory::all();
        $product =  Products::find($id);
        if(!$product) {
            return redirect()->route('admin.product.index')->with('msg_warning', 'Sản phẩm không tồn tại');
        }
        // dd($product);

        return view('layouts.backend.products.edit',compact('title','product','allCate'));
    }
    public function postEdit(ProductRequest $request, $id){
        $product = Products::find($id);
    
        if (!$product) {
            return redirect()->route('admin.product.index')->with('msg_warning', 'Sản phẩm không tồn tại');
        }
    
        // Đường dẫn mặc định đến ảnh sản phẩm hiện tại
        $filename = $product->image;
    
        if ($request->hasFile('image')) {
            // Xử lý ảnh mới
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
    
            // Tạo tên tệp mới duy nhất
            $filename = time().'.'.$extension;
    
            $path = 'backend/uploads/products/';
            $file->move(public_path($path), $filename);
    
            // Xóa ảnh cũ nếu tồn tại
            if (File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }
    
            // Cập nhật đường dẫn ảnh
            $filename = $path . $filename;
        }
    
        $dataUpdate = [
            'name' => $request->name,
            'price' => $request->price,
            'image' => $filename,
            'product_category' => $request->product_category,
            'quanlity' => $request->quanlity,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    
        Products::where('id', $id)->update($dataUpdate);
    
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
