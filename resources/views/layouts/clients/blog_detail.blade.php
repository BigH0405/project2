@include('parts.clients.header')



<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>{{ $blog->title }}</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="/blog">Blog</a>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="blog_area single-post-area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post row">
                    <div class="col-lg-12">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{ $blog->image ? asset($blog->image) : 'Không có ảnh' }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="blog_info text-right">
                            <ul class="blog_meta list">
                                <li><a href="#">{{$blog->user_id}}<i class="lnr lnr-user"></i></a></li>
                                <li><a href="#">{{ $blog->created_at->format('d M, Y') }}<i class="lnr lnr-calendar-full"></i></a></li>
                                <li><a href="#">{{ $blog->views }}<i class="lnr lnr-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 blog_details">
                        <h2>{{ $blog->title }}</h2>
                        <p class="excert">
                            {{ $blog->short_description }}
                        </p>
                        <p>
                            {!! nl2br(e($blog->description)) !!}
                        </p>
                    </div>
                    <div class="col-lg-12">
                        <div class="quotes">
                            {{ $blog->quote }}
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <img class="img-fluid" src="img/blog/post-img1.jpg" alt="">
                            </div>
                            <div class="col-6">
                                <img class="img-fluid" src="img/blog/post-img2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comments-area">
                    <h4>{{ $comments->count() }} Bình luận</h4>
                    @if (!empty($comments))
                    @foreach($comments as $comment)
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">

                                     
                                        <img src="{{asset('clients/img/product/review-1.png')}}" alt="">
                                    </div>
                                    <div class="desc">
                                        @if (Auth::check())
                                        <h5><a href="#">{{Auth::guard('web')->check() ? $user->fullname : 'Khách' }}</a></h5>
                                        @endif
                                        <p class="date">{{ $comment->created_at->format('F j, Y \a\t g:i a') }}</p>
                                        <p class="comment">{{ $comment->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p class="text-center" style="color: red">Không có bình luận nào</p>
                    @endif
                </div>
                <div class="comment-form">
                    <h4>Bình luận</h4>
                    @if (session('msg'))
                        <div class="alert alert-success">{{ session('msg') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">Dữ liệu lỗi! Vui lòng kiểm tra lại</div>
                    @endif
                    @if (Auth::check())
                    <form method="POST" action="{{ route('clients.blogscommentsstore', $blog->id) }}">
                        @csrf
                        <div class="form-group form-inline">
                            <div class="form-group col-lg-6 col-md-6 name">
                                <input type="text" class="form-control" id="name" placeholder="Nhập tên của bạn" disabled value="{{ Auth::guard('web')->check() ? $user->fullname : old('fullname') }}">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 email">
                                <input type="email" class="form-control" id="email" placeholder="Nhập email của bạn..." disabled value="{{ Auth::guard('web')->check() ? $user->email : old('email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control mb-10" rows="5" name="message" placeholder="Nhập bình luận của bạn...">{{ old('message') }}</textarea>
                            @error('message')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="primary-btn submit_btn">Đăng bình luận</button>
                    </form>
                    @else
                    <p style="color: red">Bạn phải đăng nhập mới có thể dùng chức năng!</p>
                    @endif
                </div>                
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Posts" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Posts'">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="lnr lnr-magnifier"></i></button>
                            </span>
                        </div><!-- /input-group -->
                        <div class="br"></div>
                    </aside>
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Popular Posts</h3>
                        <div class="media post_item">
                            <img src="img/blog/popular-post/post1.jpg" alt="post">
                            <div class="media-body">
                                <a href="blog-details.html">
                                    <h3>Space The Final Frontier</h3>
                                </a>
                                <p>02 Hours ago</p>
                            </div>
                        </div>
                        
                        <div class="br"></div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>

@include('parts.clients.footer')

