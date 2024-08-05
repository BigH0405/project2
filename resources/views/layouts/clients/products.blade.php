@include('parts.clients.header');

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        @if (session('msg_warning'))
        <div class="alert alert-danger">{{ session('msg_warning') }}</div>
        @endif
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>{{ $title }}</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{ route('clients.products') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Danh mục<span class="lnr lnr-arrow-right"></span></a>
                    <a href="category.html">{{ $title }}</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
            <div class="sidebar-categories">
                <div class="head">Danh mục sản phẩm</div>
                <ul class="main-categories">
                    @if(!empty($allCate))
                    @foreach($allCate as $item)
                    <li class="main-nav-list">
                        <a href="{{ route('clients.productsbyCategory', $item->id) }}">
                            <span class="lnr lnr-arrow-right"></span>{{ $item->name }}
                        </a>
                    </li>
                    @endforeach
                    @else
                    <li class="main-nav-list">
                        <a href="#">
                            <span class="lnr lnr-arrow-right">Chưa có danh mục</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center">
                <div class="sorting">
                </div>
                <div class="sorting mr-auto">
                </div>
                {{-- <h1>{{$title}}</h1> --}}
                <form action="" method="GET">
                    <div class="row mt-3">
                        <div class="col-8">
                                <input ytype="search" name="keywords" id="" class="form-control mb-3" placeholder="Nhập từ khóa tìm kiếm..." value="{{request()->keywords}}">
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>  
                </div>
                </form>
        </div>
            <!-- End Filter Bar -->
            <!-- Start Product List -->
            <section class="lattest-product-area pb-40 category-list">
                @if (session('msg'))
                <div class="alert alert-success">{{ session('msg') }}</div>
            @endif
                <div class="row">
                    @if(!empty($allProducts))
                    @foreach($allProducts as $item)
                    <!-- single product -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-product">
                            <a href="{{ route('clients.product_detail', $item->id) }}">
                                <img class="img-fluid" src="{{ $item->image ? asset($item->image) : 'Không có ảnh' }}" alt="" width="50px">
                            </a>
                            <div class="product-details">
                                <a href="{{ route('clients.product_detail', $item->id) }}">
                                    <h6>{{ $item->name }}</h6>
                                </a>
                                <div class="price">
                                    <h6>{{ $item->price }}</h6>
                                </div>
                                <div class="prd-bottom">
                                    <a href="#" class="social-info">
                                        <span class="ti-bag"></span>
                                        <p class="hover-text">Giỏ hàng</p>
                                    </a>
                                    <a href="{{ route('clients.product_detail', $item->id) }}" class="social-info">
                                        <span class="lnr lnr-move"></span>
                                        <p class="hover-text">Xem chi tiết</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>Không có sản phẩm nào trong danh mục này.</p>
                    @endif
                </div>
            </section>
            <!-- End Product List -->
            <!-- Start Pagination -->
            <nav class="blog-pagination justify-content-center d-flex">
                <ul class="pagination">
                    {{ $allProducts->links() }}
                </ul>
            </nav>
            <!-- End Pagination -->
        </div>
    </div>
</div>

<!-- Start related-product Area -->
<section class="related-product-area section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Deals of the Week</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @if(!empty($bestSellingProducts))
                    @foreach($bestSellingProducts as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="#"><img src="{{ $item->image ? asset($item->image) : 'Không có ảnh' }}" alt="" width="50px"></a>
                            <div class="desc">
                                <a href="#" class="title">{{ $item->name }}</a>
                                <div class="price">
                                    <h6>{{ $item->price }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End related-product Area -->

<!-- start footer Area -->
@include('parts.clients.footer');
<!-- End footer Area -->
<!-- Modal Quick Product View -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="container relative">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="product-quick-view">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="quick-view-carousel">
                            <div class="item" style="background: url(img/organic-food/q1.jpg);"></div>
                            <div class="item" style="background: url(img/organic-food/q1.jpg);"></div>
                            <div class="item" style="background: url(img/organic-food/q1.jpg);"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="quick-view-content">
                            <div class="top">
                                <h3 class="head">Mill Oil 1000W Heater, White</h3>
                                <div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">$149.99</span></div>
                                <div class="category">Category: <span>Household</span></div>
                                <div class="available">Availability: <span>In Stock</span></div>
                            </div>
                            <div class="middle">
                                <p class="content">Mill Oil is an innovative oil filled radiator with the most modern technology. If you are looking for something that can make your interior look awesome, and at the same time give you the pleasant warm feeling during the winter.</p>
                                <a href="#" class="view-full">View full Details <span class="lnr lnr-arrow-right"></span></a>
                            </div>
                            <div class="bottom">
                                <div class="color-picker d-flex align-items-center">Color:
                                    <span class="single-pick"></span>
                                    <span class="single-pick"></span>
                                    <span class="single-pick"></span>
                                    <span class="single-pick"></span>
                                    <span class="single-pick"></span>
                                </div>
                                <div class="quantity-container d-flex align-items-center mt-15">
                                    Quantity:
                                    <input type="text" class="quantity-amount ml-15" value="1" />
                                    <div class="arrow-btn d-inline-flex flex-column">
                                        <button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
                                        <button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
                                    </div>
                                </div>
                                <div class="d-flex mt-20">
                                    <a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
                                    <a href="#" class="like-btn"><span class="lnr lnr-layers"></span></a>
                                    <a href="#" class="like-btn"><span class="lnr lnr-heart"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
