<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\ProductCategory;
use App\Http\Requests\admin\ProductCategoryRequest;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('keywords');
        $query = ProductCategory::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $categories = $query->orderBy('id', 'DESC')->paginate(3);

        return response()->json($categories);
    }

    public function show($id)
    {
        $category = ProductCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Danh mục không tồn tại'], 404);
        }

        return response()->json($category);
    }

    public function store(ProductCategoryRequest $request)
    {
        $dataInsert = [
            'name' => $request->name,
            'create_at' => now()
        ];
        $category = ProductCategory::create($dataInsert);

        return response()->json([
            'message' => 'Danh mục sản phẩm đã được thêm thành công',
            'category' => $category
        ], 201);
    }

    public function update(ProductCategoryRequest $request, $id)
    {
        $category = ProductCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Danh mục không tồn tại'], 404);
        }

        $dataUpdate = [
            'name' => $request->name,
        ];

        $category->update($dataUpdate);

        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = ProductCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Danh mục không tồn tại'], 404);
        }

        $productCount = $category->products()->count();

        if ($productCount > 0) {
            return response()->json(['message' => "Không thể xóa danh mục này vì còn $productCount sản phẩm đang sử dụng!"], 400);
        }

        $category->delete();

        return response()->json(['message' => 'Xóa danh mục thành công']);
    }
}
