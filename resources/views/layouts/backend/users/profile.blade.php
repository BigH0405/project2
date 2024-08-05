@include('parts.backend.header')
<div id="layoutSidenav">
    @include('parts.backend.sidebar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="text-center mb-3 mt-3">Thông tin quản trị viên</h1>
                @if (session('msg'))
                    <div class="alert alert-success">{{session('msg')}}</div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">Dư liệu nhập vào sai! Vui lồng kiểm tra lại</div>
                @endif
                <form action="{{route('admin.profileupdate')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="fullname" value="{{ !empty($user) ? $user->fullname : old('fullname') }}" placeholder="Nhập họ và tên...">
                            @error('fullname')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-6" >
                            <label for="">Email</label>
                            <input type="email" class="form-control" id="email" name="email" disabled value="{{ !empty($user) ? $user->email : old('email') }}" placeholder="Nhập email...">
                            @error('email')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ !empty($user) ? $user->phone : old('phone') }}" placeholder="Nhập số điện thoại...">
                            @error('phone')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{!empty($user) ? $user->address : old('address') }}" placeholder="Nhập địa chỉ...">
                            @error('address')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Cập nhập</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
</div>
        </main>
        @include('parts.backend.footer')