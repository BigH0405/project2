<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactClientController extends Controller
{
    public function index(){
        return view('layouts.clients.contact');
    }
}
