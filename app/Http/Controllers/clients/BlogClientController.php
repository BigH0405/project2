<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogClientController extends Controller
{
    public function index(){
        return view('layouts.fontend.blog');
    }
}
