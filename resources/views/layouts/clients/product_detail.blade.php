
	<!-- Start Header Area -->
	@include('parts.clients.header')
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>{{$title}}</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="single-product.html">{{$title}}</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_Product_carousel">
						<div class="single-prd-item">
							<img class="img-fluid" src="{{asset('clients/img/category/s-p1.jpg')}}" alt="">
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="{{asset('clients/img/category/s-p1.jpg')}}" alt="">
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="{{asset('clients/img/category/s-p1.jpg')}}" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">

					<div class="s_product_text">
						<h3>{{$product->name}}</h3>
						<h2>{{$product->price}}</h2>
						<ul class="list">
							<li><a class="active" href="#"><span>Category</span> :{{ $product->productCate ? $product->productCate->name : 'Không có danh mục' }}</a></li>
							<li><a href="#"><span>Availibility</span> : {{$product->quanlity}}</a></li>
						</ul>
						<p>{{$product->short_description}}</p>
						<div class="product_count">
							<label for="qty">Quantity:</label>
							<input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
							 class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
							 class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
						</div>
						<div class="card_area d-flex align-items-center">
							<a class="primary-btn" href="#">Mua ngay</a>
							<a class="primary-btn" href="#">Thêm vào giỏ hàng</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mô tả</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
					 aria-selected="false">Đánh giá</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
					<p>{{$product->description}}</p>
				</div>
				<div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
					<div class="row">
						<div class="col-lg-6">
							<div class="row total_rate">
								<h1 class="text-center">Đánh giá sản phẩm</h1>
							</div>
							<div class="review_list">
								<div class="review_item">
									@if (!empty($allReviews))	
									@foreach ($allReviews as $item)
									<div class="media">
										<div class="d-flex">
											<img src="{{asset('clients/img/product/review-1.png')}}" alt="">
										</div>
										<div class="media-body">
											<h4>{{$item->User->fullname}}</h4>
										</div>
									</div>
									<p>{{$item->messege}}</p>
									@endforeach
									@else
									<p class="text-center">Sản phẩm không có bình luận nào</p>							
									@endif
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Đánh giá</h4>
								@if (session('msg'))
									<div class="alert alert-success">{{session('msg')}}</div>
								@endif
								@if ($errors->any())
									<div class="alert alert-danger text-center">Dữ liệu lỗi! Vui lòng kiểm trả lại</div>
								@endif
							</div>
							@if (Auth::check())
							<form class="row contact_form" action="{{ route('clients.productsreviewsstore', $product->id) }}" method="post">
								@csrf
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" class="form-control" id="name" name="fullname" placeholder="Nhập tên của bạn..." disabled value="{{ Auth::guard('web')->check() ? $user->fullname : old('fullname') }}">
									</div>
									@error('fullname')
									<span style="color: red">{{ $message }}</span>
									@enderror
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" class="form-control" id="email" name="email" placeholder="Nhập email của bạn..." disabled value="{{ Auth::guard('web')->check() ? $user->email : old('email') }}">
									</div>
									@error('email')
									<span style="color: red">{{ $message }}</span>
									@enderror
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<textarea class="form-control" name="messege" id="message" rows="1" placeholder="Nhập đánh giá của bạn..." value="{{old('messege')}}"></textarea>
									</div>
									@error('messege')
									<span style="color: red">{{ $message }}</span>
									@enderror
								</div>
								<div class="col-md-12 text-right">
									<button type="submit" value="submit" class="primary-btn">Đăng đánh giá</button>
								</div>
							</form>
							@else
							<p style="color: red">Bạn phải đăng nhập mới có thể dùng chức năng!</p>
							@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->

	<!-- Start related-product Area -->
	<section class="related-product-area section_gap_bottom">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>Sản phẩm mới nhất</h1>
						<p>Đây là phần giới thiệu về các sản phẩm mới nhất của chúng tôi. Hãy khám phá những sản phẩm độc đáo và chất lượng cao, 
							được chọn lọc kỹ lưỡng để mang đến trải nghiệm tuyệt vời cho bạn.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						@if (!empty($bestSellingProducts))
						@foreach ($bestSellingProducts as $item)
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="{{ $item->image ? asset($item->image) : 'Không có ảnh' }}" alt="" width="50px"></a>
								<div class="desc">
									<a href="#" class="title">{{$item->name}}</a>
									<div class="price">
										<h6>{{$item->price}}</h6>
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
