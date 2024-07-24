<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\BlogRequest;
use App\Models\admin\Blog;
use App\Models\admin\Users;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index(Request $request){
        $title = "Bài viết";
        $search = null;
        $search = $request->input('keywords');
        $query = Blog::query()->with('User');
        if ($search) {
            $query->where('title', 'like', '%'.$search.'%');
        }
        $allBlog = $query->paginate(5)->withQueryString();
        return view('layouts.backend.blogs.lists',compact('title','allBlog'));
    }

    public function add(){
        $title = 'Thêm mới bài viết';
        $allUser = Users::all();
        // $allCate = BlogCategory::all();
        return view('layouts.backend.blogs.add',compact('title','allUser'));
    }

    public function postAdd(BlogRequest $request){
       $dataInsert = [
            'title' => $request->title,
            'image' => $request->image,
            'views' => $request->views,
            'user_id' => $request->user_id,
            'blog_id' => $request->blog_id,
            'short_description' => $request->short_description,
            'description' => $request->description,
       ];
        // dd($dataInsert);
        Blog::create($dataInsert);
        return redirect()->route('admin.blog.index')->with('msg', 'Thêm bài viết thành công');
    }
    public function edit($id){
        $title = "Cập nhật sản phẩm";
        $Blog = Blog::find($id);
        $allUser = Users::all();
        if(!$Blog){
            return redirect()->route('admin.blog.index')->with('msg_warning','Bài viết không tồn tại');
        }
        return view('layouts.backend.blogs.edit',compact('title','Blog','allUser'));
    }
    public function postEdit(BlogRequest $request, $id){
        $Blog = Blog::find($id);
        if(!$Blog){
            return redirect()->route('admin.blog.index')->with('msg_warning','Bài viết không tồn tại');
        }
        $dataUpdate = [
            'title' => $request->title,
            'image' => $request->image,
            'views' => $request->views,
            'user_id' => $request->user_id,
            'blog_id' => $request->blog_id,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        // dd($dataUpdate);
        Blog::postEdit($id,$dataUpdate);
        return back()->with('msg',"Sửa sản phẩm thành công");
    }
    public function delete($id){
        $Blog = Blog::query()->find(1)->delete();
        if($Blog){
            Blog::destroy($id);
            return redirect()->route('admin.blog.index')->with('msg',"Xóa sản phẩm thành công");
        }
        return redirect()->route('admin.blog.index')->with('msg_warning',"Sản phẩm không tồn tại");
    }
}