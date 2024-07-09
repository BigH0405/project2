<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\ProductCategory;
use App\Http\Requests\admin\ProductCategoryRequest;
class ProductCategoryController extends Controller
{
    public function index(){
        $title = "Danh sách sản phẩm";

        $allCate = ProductCategory::all();
        return view('layouts.backend.product_category.lists',compact('title','allCate'));
    }

    public function add(){
        $title = "Thêm mới danh sách sản phẩm";

        return view('layouts.backend.product_category.add',compact('title'));
        
    }

    public function postAdd(ProductCategoryRequest $request){
        $dataInsert = [
            'name' => $request->name,
            'create_at'=>date('Y-m-d H:i:s')
        ];
        ProductCategory::create($dataInsert);
        return redirect()->route('admin.cate.index')->with('msg',"Thêm danh mục thành công");
    }

    public function edit($id){
        $title = "Sửa danh mục sản phẩm";
        $cate = ProductCategory::find($id);
        return view('layouts.backend.product_category.edit',compact('title','cate'));
    }

    public function postEdit(ProductCategoryRequest $request, $id){
        $cate = ProductCategory::find($id);

        if(!$cate) {
            return redirect()->route('admin.cate.index')->with('msg', 'Danh mục không tồn tại');
        }

        $dataUpdate = [
            'name' => $request->name,
        ];

        // Gọi phương thức tĩnh từ model để cập nhật danh mục sản phẩm
        ProductCategory::postEdit($id, $dataUpdate);

        return back()->with('msg', "Sửa danh mục thành công");
    }

    public function delete($id){
        $cate = ProductCategory::find($id);
        ProductCategory::destroy($id);
        return redirect()->route('admin.cate.index')->with('msg',"Xóa danh mục thành công");


    }
}
