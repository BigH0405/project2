<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function index(){
        $title = "Danh sách sản phẩm";

        $allProduct = Products::all();
        return view('layouts.backend.products.lists',compact('title','allProduct'));
    }
}
