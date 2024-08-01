	@include('parts.clients.header')
	<!-- End Header Area -->

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Blog Page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{route('clients.lists')}}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{route('clients.blogs')}}">Blog</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Blog Categorie Area =================-->
    <section class="blog_categorie_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="categories_post">
                        <img src="{{asset('clients/img/blog/cat-post/cat-post-3.jpg')}}" alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="blog-details.html">
                                    <h5>Social Life</h5>
                                </a>
                                <div class="border_line"></div>
                                <p>Enjoy your social life together</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories_post">
                        <img src="{{asset('clients/img/blog/cat-post/cat-post-2.jpg')}}" alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="blog-details.html">
                                    <h5>Politics</h5>
                                </a>
                                <div class="border_line"></div>
                                <p>Be a part of politics</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories_post">
                        <img src="{{asset('clients/img/blog/cat-post/cat-post-1.jpg')}}" alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="blog-details.html">
                                    <h5>Food</h5>
                                </a>
                                <div class="border_line"></div>
                                <p>Let the food be finished</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Categorie Area =================-->

    <!--================Blog Area =================-->
    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        @foreach($allBlogs as $key => $item)
                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a class="active" href="#">{{$item->BlogCate ? $item->BlogCate->name :'Không có danh mục'}}</a>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#">{{$item->User ? $item->User->fullname : 'Không có tác giả'}}<i class="lnr lnr-user"></i></a></li>
                                        <li><a href="#">{{$item->created_at}}<i class="lnr lnr-calendar-full"></i></a></li>
                                        <li><a href="#">{{$item->views}}<i class="lnr lnr-eye"></i></a></li>
                                        <li><a href="#">{{{$messege}}}<i class="lnr lnr-bubble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="{{asset('clients/img/blog/main-blog/m-blog-1.jpg')}}" alt="">
                                    <div class="blog_details">
                                        <a href="single-blog.html">
                                            <h2>{{$item->title}}</h2>
                                        </a>
                                        <p>{{$item->short_description}}</p>
                                        <a href="single-blog.html" class="white_bg_btn">View More</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        @endforeach
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                {{-- <li class="page-item"><a href="#" class="page-link">{{$allBlogs->links()}}
                                </a></li> --}}
                                <li class="page-item">{{$allBlogs->links()}}</li>
                                {{-- <li class="page-item"><a href="#" class="page-link">03</a></li>
                                <li class="page-item"><a href="#" class="page-link">04</a></li>
                                <li class="page-item"><a href="#" class="page-link">09</a></li> --}}
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="" method="get">
                            <div class="input-group">
                                <input type="text" name="keywords" class="form-control" placeholder="Tìm kiếm" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tìm kiếm'">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="lnr lnr-magnifier"></i></button>
                                </span>
                            </div>
                        </form><!-- /input-group -->
                            <div class="br"></div>
                        </aside>
                        {{-- <aside class="single_sidebar_widget author_widget">
                            <img class="author_img rounded-circle" src="{{asset('clients/img/blog/author.png')}}" alt="">
                            <h4>Charlie Barber</h4>
                            <p>Senior blog writer</p>
                            <div class="social_icon">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-github"></i></a>
                                <a href="#"><i class="fa fa-behance"></i></a>
                            </div>
                            <p>Boot camps have its supporters andit sdetractors. Some people do not understand why you
                                should have to spend money on boot camp when you can get. Boot camps have itssuppor
                                ters andits detractors.</p>
                            <div class="br"></div>
                        </aside> --}}
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Popular Posts</h3>
                        @foreach($allTop as $key => $item)
                            <div class="media post_item">
                                <img src="{{asset('clients/img/blog/popular-post/post1.jpg')}}" alt="post">
                                <div class="media-body">
                                    <a href="blog-details.html">
                                        <h3>{{$item->title}}</h3>
                                    </a>
                                    <p>{{$item->created_at}}</p>
                                </div>
                            </div>
                            @endforeach
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget ads_widget">
                            <a href="#"><img class="img-fluid" src="{{asset('clients/img/blog/add.jpg')}}" alt=""></a>
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Post Catgories</h4>
                            <ul class="list cat-list">
                        @foreach($allBlogs as $key => $item)
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>{{$item->BlogCate ? $item->BlogCate->name :'Không có danh mục'}}</p>
                                        <p>37</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="br"></div>
                        </aside>
                        <aside class="single-sidebar-widget tag_cloud_widget">
                            <h4 class="widget_title">Tag Clouds</h4>
                            <ul class="list">
                        @foreach($allBlogs as $key => $item)
                                <li><a href="#">{{$item->BlogCate ? $item->BlogCate->name :'Không có danh mục'}}</a></li>
                        @endforeach
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

    <!-- start footer Area -->
    @include('parts.clients.footer')