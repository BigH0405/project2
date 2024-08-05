    @include('parts.clients.header');
	<!-- End Header Area -->

	<!-- start banner Area -->
	<section class="banner-area">
		<div class="container">
			@if (session('msg'))
			<div class="alert alert-danger">
				{{session('msg')}}
			</div>
		@endif
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="active-banner-slider owl-carousel">
						<!-- single-slide -->
						@if (!empty($productBanner))
							@foreach ($productBanner as $item)
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h1>{{$item->name}}</h1>
									<p>{{$item->short_description}}</p>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
										<span class="add-text text-uppercase">Thêm vào giỏ hàng</span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="{{ $item->image ? asset($item->image) : 'Không có ảnh' }}" alt="">
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
	<!-- End banner Area -->

	<!-- start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="{{asset('clients/img/features/f-icon1.png')}}" alt="">
						</div>
						<h6>Giao hàng miễn phí</h6>
						<p>Miễn phí vận chuyển cho tất cả các đơn hàng</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="{{asset('clients/img/features/f-icon2.png')}}" alt="">
						</div>
						<h6>Chính sách đổi trả</h6>
						<p>Hỗ trợ đổi trả dễ dàng và nhanh chóng</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="{{asset('clients/img/features/f-icon3.png')}}" alt="">
						</div>
						<h6>Hỗ trợ 24/7</h6>
						<p>Chúng tôi luôn sẵn sàng hỗ trợ bạn bất cứ lúc nào</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="{{asset('clients/img/features/f-icon4.png')}}" alt="">
						</div>
						<h6>Thanh toán an toàn</h6>
						<p>Bảo mật thông tin thanh toán của bạn</p>
					</div>
				</div>
			</div>
		</div>
	</section>	
	<!-- end features Area -->

	<!-- Start category Area -->
	<section class="category-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-12">
					<div class="row">
						<div class="col-lg-8 col-md-8">
							@if (!empty($allCate))
								@foreach ($allCate as $item)
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="{{asset('clients/img/category/c1.jpg')}}" alt="">
								<a href="#" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title">{{$item->name}}</h6>
									</div>
								</a>
							</div>
							@endforeach
							@endif
						</div>
						<div class="col-lg-4 col-md-4">
							@if (!empty($allCate))
								@foreach ($allCate as $item)
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="{{asset('clients/img/category/c2.jpg')}}" alt="">
								<a href="#" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title">{{$item->name}}</h6>
									</div>
								</a>
							</div>
							@endforeach
							@endif
						</div>
						<div class="col-lg-4 col-md-4">
							@if (!empty($allCate))
								@foreach ($allCate as $item)
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="{{asset('clients/img/category/c3.jpg')}}" alt="">
								<a href="#" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title">{{$item->name}}</h6>
									</div>
								</a>
							</div>
							@endforeach
							@endif
						</div>
						<div class="col-lg-8 col-md-8">
							@if (!empty($allCate))
								@foreach ($allCate as $item)
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="{{asset('clients/img/category/c4.jpg')}}" alt="">
								<a href="#" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title">{{$item->name}}</h6>
									</div>
								</a>
							</div>
						</div>
						@endforeach
						@endif
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					@if (!empty($allCate))
						@foreach ($allCate as $item)
					<div class="single-deal">
						<div class="overlay"></div>
						<img class="img-fluid w-100" src="{{asset('clients/img/category/c5.jpg')}}" alt="">
						<a href="#" class="img-pop-up" target="_blank">
							<div class="deal-details">
								<h6 class="deal-title">{{$item->name}}</h6>
							</div>
						</a>
					</div>
					@endforeach
					@endif
				</div>

			</div>
		</div>
	</section>
	<!-- End category Area -->

	<!-- start product Area -->
	<section class="owl-carousel active-product-area section_gap">
		<!-- single product slide -->
		<div class="single-product-slider">
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
					<!-- single product -->
					@if (!empty($products))
						@foreach ($products as $item)
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="{{ $item->image ? asset($item->image) : 'Không có ảnh' }}" alt="" width="100px">
							<div class="product-details">
								<h6>{{$item->name}}</h6>
								<div class="price">
									<h6>{{$item->price}}</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@endif
					<!-- single product -->
				</div>
			</div>
		</div>
		<!-- single product slide -->
		<div class="single-product-slider">
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
					<!-- single product -->
					@if (!empty($products))
						@foreach ($products as $item)
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="{{ $item->image ? asset($item->image) : 'Không có ảnh' }}" alt="" width="100px">
							<div class="product-details">
								<h6>{{$item->name}}</h6>
								<div class="price">
									<h6>{{$item->price}}</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@endif
				</div>
			</div>
		</div>
	</section>

	<!-- Start brand Area -->
	<section class="brand-area section_gap">
		<div class="container">
			<div class="row">
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="{{asset('clients/img/brand/1.png')}}" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="{{asset('clients/img/brand/2.png')}}" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="{{asset('clients/img/brand/3.png')}}" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="{{asset('clients/img/brand/4.png')}}" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="{{asset('clients/img/brand/5.png')}}" alt="">
				</a>
			</div>
		</div>
	</section>
	<!-- End brand Area -->

	<!-- Start related-product Area -->
	<section class="related-product-area section_gap_bottom">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>Sản phẩm bán chạy</h1>
						<p>Khám phá những sản phẩm đang được ưa chuộng nhất! Đây là các mặt hàng bán chạy nhất trong thời gian gần đây,
						được yêu thích bởi nhiều khách hàng. Đừng bỏ lỡ cơ hội sở hữu những sản phẩm chất lượng cao và phổ biến này.</p>

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
