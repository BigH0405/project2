@include('parts.clients.header')

<section class="blog_area single-post-area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 posts-list">
                <div class="comment-form">
                    <h4>Thông tin người dùng</h4>
                    @if (session('msg'))
                        <div class="alert alert-success">{{ session('msg') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">Dữ liệu lỗi! Vui lòng kiểm tra lại</div>
                    @endif
                    <form method="POST" action="{{ route('clients.profileupdate') }}">
                        @csrf
                        <div class="form-group form-inline">
                            <div class="form-group col-lg-6 col-md-6 name">
                                <input type="text" class="form-control" id="name" name="fullname" value="{{ !empty($user) ? $user->fullname : old('fullname') }}">
                            </div>
                            @error('fullname')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                            <div class="form-group col-lg-6 col-md-6 email">
                                <input type="email" class="form-control" id="email" name="email" disabled value="{{ !empty($user) ? $user->email : old('email') }}">
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <div class="form-group col-lg-6 col-md-6 name">
                                <input type="text" class="form-control" id="phone" name="phon   e" value="{{ !empty($user) ? $user->phone : old('phone') }}">
                            </div>
                            @error('phone')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                            <div class="form-group col-lg-6 col-md-6 email">
                                <input type="text" class="form-control" id="address" name="address" value="{{ Auth::guard('web')->check() ? $user->address : old('address') }}">
                            </div>
                            @error('address')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group form-inline">
                            <div class="form-group col-lg-6 col-md-6 name">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới">
                            </div>
                            @error('password')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</section>

@include('parts.clients.footer')
