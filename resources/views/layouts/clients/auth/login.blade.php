@include('parts.clients.header')

<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Đăng nhập/Đăng ký</h1>
                <nav class="d-flex align-items-center">
                    <a href="#">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Đăng nhập/Đăng ký</a>
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
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="{{asset('clients/img/login.jpg')}}" alt="">
                    <div class="hover">
                        <h4>Bạn là người dùng mới</h4>
                        <p>Hãy click vào nút bên dưới để tạo tài khoản, sử dụng các dịch vụ của chúng tôi</p>
                        <a class="primary-btn" href="#">Đăng ký tài khoản</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Đăng nhập</h3>
                    @if ($errors->any())
                    <div class="alert alert-danger text-center">Vui lòng kiểm tra lại dữ liệu</div> 
                    @endif
                    @if (session('msg'))
                    <div class="alert alert-success text-center">{{session('msg')}}</div>
                    @endif
                    @if (session('msg_warning'))
                    <div class="alert alert-danger text-center">{{session('msg_warning')}}</div>
                    @endif
                    <form class="row login_form" action="{{ route('clients.post-login') }}" method="POST">
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="name" name="email" placeholder="Nhập Email..." value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="name" name="password" placeholder="Nhập mật khẩu..." value="{{ old('password') }}">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="selector">
                                <label for="f-option2">Ghi nhớ mật khẩu</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="primary-btn">Đăng nhập</button>
                            @if (Route::has('password.request'))
                            <a href="#">Quên mật khẩu?</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('parts.clients.footer')
