<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Oder;
use Illuminate\Http\Request;

class OderController extends Controller
{
    public function index()
    {
        $orderDetails = Oder::all();
        return view('admin.order_details.index', compact('orderDetails'));
    }
}
