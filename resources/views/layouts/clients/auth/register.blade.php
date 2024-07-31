@include('parts.clients.header')

<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>{{$title}}</h1>
                <nav class="d-flex align-items-center">
                    <a href="#">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">{{$title}}</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Login Box Area =================-->
<section class="login_box_area section_gap">
    <div class="container">
        <div class="row">
            {{-- <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="{{asset('clients/img/login.jpg')}}" alt="">
                    <div class="hover">
                        <h4>Bạn là người dùng mới</h4>
                        <p>Hãy click vào nút bên dưới để tạo tài khoản, sử dụng các dịch vụ của chúng tôi</p>
                        <a class="primary-btn" href="#">Đăng ký tài khoản</a>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-12">
                <div class="login_form_inner">
                    <h3>{{$title}}</h3>
                    @if ($errors->any())
                    <div class="alert alert-danger text-center">Vui lòng kiểm tra lại dữ liệu</div> 
                    @endif
                    @if (session('msg'))
                    <div class="alert alert-success text-center">{{session('msg')}}</div>
                    @endif
                    @if (session('msg_warning'))
                    <div class="alert alert-danger text-center">{{session('msg_warning')}}</div>
                    @endif
                    <form class="row login_form" action="{{route('clients.post-register')}}" method="POST">
                        @csrf
                        <div class="col-md-12 form-group">
                            <input id="name" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" autocomplete="fullname" autofocus placeholder="Nhập Tên của bạn...">

                            @error('fullname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input id="name" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Nhập email của bạn...">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input id="name" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="password" autofocus placeholder="Nhập mật khẩu của bạn...">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input id="name" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="password_confirmation" autofocus placeholder="Nhập lại mật khẩu của bạn...">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input id="name" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus placeholder="Nhập số điện thoại của bạn...">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>  
                        <div class="col-md-12 form-group">
                            <input id="name" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus placeholder="Nhập địa chỉ của bạn...">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>  
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="primary-btn">Đăng ký</button>
                            <a href="{{route('clients.login')}}" style="color: #01A4DB">Quay về đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('parts.clients.footer')
