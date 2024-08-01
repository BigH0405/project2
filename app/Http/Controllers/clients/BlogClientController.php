<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\admin\BlogCategory;
use App\Models\admin\Comments;
use App\Models\clients\Blogs;
use Illuminate\Http\Request;

class BlogClientController extends Controller
{
    public function index(Request $request){
        $messege=Comments::count();
        $search = null;
        $search = $request->input('keywords');
        $query = Blogs::query();
        if ($search) {
            $query->where('title', 'like', '%'.$search.'%');
            }
        $allBlogs = $query->orderBy('id','DESC')->paginate(5)->withQueryString();
        $allTop = $query->orderBy('views','DESC')->paginate(4)->withQueryString();
        return view('layouts.clients.blog',compact('allBlogs','messege','allTop'));
    }
}
