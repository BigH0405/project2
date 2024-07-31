@include('parts.clients.header')

<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Xác thực Email</h1>
                <nav class="d-flex align-items-center">
                    <a href="#">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Xác thực email</a>
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
                    <h3>Xác thực email</h3>
                    @if ($errors->any())
                    <div class="alert alert-danger text-center">Vui lòng kiểm tra lại dữ liệu</div> 
                    @endif
                    @if (session('msg'))
                    <div class="alert alert-success text-center">{{session('msg')}}</div>
                    @endif
                    @if (session('msg_warning'))
                    <div class="alert alert-danger text-center">{{session('msg_warning')}}</div>
                    @endif
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{session('message')}}
                    </div>
                @endif

                Trước đó hãy kiểm tra email đã được gửi liên kết xác thực hay chưa.
                Nếu chưa được gửi
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">vui lòng ấn ở đây</button>.
                </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('parts.clients.footer')
