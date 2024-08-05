<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\admin\BlogCategory;
use App\Models\admin\Comments;
use App\Models\clients\BlogCate;
use App\Models\clients\Blogs;
use App\Models\clients\CommentClients;
use App\Models\clients\ProductsCate;
use App\Models\clients\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogClientController extends Controller
{
    public function index(Request $request){
        $nav = ProductsCate::get();
        $messege=Comments::count();
        $search = null;
        $search = $request->input('keywords');
        $query = Blogs::query();
        $top = Blogs::query();
        if ($search) {
            $query->where('title', 'like', '%'.$search.'%');
            }
        $allBlogs = $query->orderBy('id','DESC')->paginate(5)->withQueryString();
        $allTop = $top->orderBy('views','DESC')->paginate(4)->withQueryString();
        $allCate = BlogCate::orderBy("id", "desc")->limit(1)->get();

        if (Auth::guard('web')->check()) {
            // Lấy thông tin người dùng từ guard 'web'
            $user = Auth::guard('web')->user();
            return view('layouts.clients.blog',compact('allBlogs','messege','allTop','allCate','user','nav'));
        }
        // Chuyển hướng tới trang đăng nhập với thông báo cảnh báo
        return view('layouts.clients.blog',compact('allBlogs','messege','allTop','allCate','nav'));
}


public function showDetail(Request $request, $id){
    // Lấy thông tin danh mục sản phẩm
    $nav = ProductsCate::get();

    // Đếm số lượng bình luận
    $messege = CommentClients::count();

    // Lấy thông tin bài viết theo ID
    $blog = Blogs::findOrFail($id);

    // Lấy các bình luận liên quan đến bài viết
    $comments = CommentClients::where('blog_id', $id)->orderBy('created_at', 'DESC')->get();

    // Lấy danh mục bài viết
    $allCate = BlogCate::orderBy("id", "desc")->limit(1)->get();

    // Kiểm tra nếu người dùng đã đăng nhập
    if (Auth::guard('web')->check()) {
        // Lấy thông tin người dùng từ guard 'web'
        $user = Auth::guard('web')->user();
        // Trả về view chi tiết bài viết với dữ liệu cần thiết
        return view('layouts.clients.blog_detail', compact('blog', 'comments', 'messege', 'allCate', 'user', 'nav'));
    }

    // Trả về view chi tiết bài viết với dữ liệu cần thiết (không có thông tin người dùng)
    return view('layouts.clients.blog_detail', compact('blog', 'comments', 'messege', 'allCate', 'nav'));
}

public function storeComments(Request $request, $id)
{
    $request->validate([
        'message' => 'required|string|max:255',
    ], [
        'message.required' => 'Đánh giá không được để trống',
        'message.string' => 'Đánh giá phải là một chuỗi ký tự.',
        'message.max' => 'Đánh giá không được vượt quá 255 ký tự.',
    ]);

    // Lấy thông tin người dùng đã đăng nhập
    $user = Auth::guard('web')->user();

    // Lưu đánh giá
    $comment = new CommentClients();
    $comment->user_id = $user->id;
    $comment->blog_id = $id;
    $comment->message = $request->message;
    $comment->created_at = now();
    $comment->updated_at = now();
    $comment->save();

    return back()->with('msg', 'Bình luận của bạn đã được gửi');
}




}