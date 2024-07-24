
@include('parts.backend.header')
<div id="layoutSidenav">
    @include('parts.backend.sidebar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="text-center mb-3 mt-3">{{ $title }}</h1>
                @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif
                @if (session('msg_warning'))
                    <div class="alert alert-danger">{{ session('msg_warning') }}</div>
                @endif
                <a href="{{ route('admin.user.index') }}" class="btn btn-warning mb-3">Quay về</a>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="">Họ và tên</label>
                            <input type="text" name="fullname" class="form-control"
                                placeholder="Nhập họ và tên..." value="{{ old('fullname') ?? $user->fullname}}">
                            @error('fullname')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Nhập email..."
                                value="{{ old('email') ?? $user->email}}">
                            @error('email')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Mật khẩu</label>
                            <input type="text" name="password" class="form-control" placeholder="Nhập mật khẩu..." value="{{ old('password') ?? $user->password}}">
                            @error('password')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Nhập lại mật khẩu</label>
                            <input type="text" name="confirm_password" class="form-control" value="{{ old('confirm_password') ?? $user->confirm_password}}" placeholder="Nhập lại mật khẩu...">
                            @error('confirm_password')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone') ?? $user->phone}}" placeholder="Nhập số điện thoại...">
                            @error('phone')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Địa chỉ</label>
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address') ?? $user->address}}" placeholder="Nhập địa chỉ...">
                            @error('address')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Trạng thái</label>
                            <select name="status" id="" class="form-control">
                                <option value="0" {{old('status')==0 || $user->status==0 ?'selected':false}}>Chưa kích hoạt</option>
                                <option value="1" {{old('status')==1 || $user->status==1?'selected':false}}>Kích hoạt</option>
                            </select>
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Nhóm</label>
                            <select name="group_id" id="" class="form-control">
                                <option value="0">Chọn nhóm</option>
                                @if(!empty($allGroup))
                                @foreach ($allGroup as $item)
                                <option value="{{$item->id}}" {{old('group_id')==$item->id || $user->group_id==$item->id?'selected':false}}>{{$item->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('group_id')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-success" type="submit">Thêm mới</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
        </div>
        </main>
        @include('parts.backend.footer')
