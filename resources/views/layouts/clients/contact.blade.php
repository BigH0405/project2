
@include('parts.clients.header')
<!-- End Header Area -->

<!-- Start Banner Area -->
<section class="banner-area organic_breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Liên hệ với chúng tôi</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{route('clients.lists')}}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="{{route('clients.contacts')}}">Liên hệ</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Contact Area =================-->
<section class="contact_area section_gap_bottom">
    <div class="container">
        <div id="mapBox" class="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
             data-mlat="40.701083" data-mlon="-74.1522848">
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="contact_info">
                    <div class="info_item">
                        <i class="lnr lnr-home"></i>
                        <h6>California, United States</h6>
                        <p>Santa monica bullevard</p>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-phone-handset"></i>
                        <h6><a href="#">00 (440) 9865 562</a></h6>
                        <p>Mon to Fri 9am to 6 pm</p>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-envelope"></i>
                        <h6><a href="#">support@colorlib.com</a></h6>
                        <p>Send us your query anytime!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                @if (session('msg'))
                <div class="alert alert-success">{{ session('msg') }}</div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu</div>
                @endif
                <form class="row contact_form" action="{{ route('clients.post-contacts') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="fullname" placeholder="Họ và Tên" 
                                   value="{{ Auth::guard('web')->check() ? $user->fullname : old('fullname') }}">
                        </div>
                        @error('fullname')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" 
                                   value="{{ Auth::guard('web')->check() ? $user->email : old('email') }}">
                        </div>
                        @error('email')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" 
                                   value="{{ Auth::guard('web')->check() ? $user->phone : old('phone') }}">
                        </div>
                        @error('phone')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" rows="1" placeholder="Gửi thông điệp của bạn">{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" class="primary-btn">Gửi liên hệ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--================Contact Area =================-->

<!-- start footer Area -->
<!-- End footer Area -->

@include('parts.clients.footer')
