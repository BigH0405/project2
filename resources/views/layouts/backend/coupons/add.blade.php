    @include('parts.backend.header')
    <div id="layoutSidenav">
        @include('parts.backend.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="text-center mb-3 mt-3">{{$title}}</h1>
                    @if (session('msg_warning'))
                    <div class="alert alert-danger">{{session('msg_warning')}}</div>
                    @endif
                    <a href="{{route('admin.coupons.index')}}" class="btn btn-warning mb-3">Quay về</a>
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="">Tên mã</label>
                                <input type="text" name="code" class="form-control" placeholder="Nhập tên mã..." value="{{old('code')}}">
                                @error('code')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Giảm giá</label>
                                <input type="text" name="discount" class="form-control" placeholder="Nhập số tiền giảm..." value="{{old('discount')}}">
                                @error('discount')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Số lượng</label>
                                <input type="text" name="quantily" class="form-control" placeholder="Nhập số lượng..." value="{{old('quantily')}}">
                                @error('quantily')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Ngày bắt đầu</label>
                                <input type="date" name="start_day" class="form-control" placeholder="Nhập tên mã..." value="{{old('start_day')}}">
                                @error('start_day')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Ngày kết thúc</label>
                                <input type="date" name="end_day" class="form-control" value="{{old('end_day')}}">
                                @error('end_day')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">User_id</label>
                                <select name="user_id" id="" class="form-control">
                                    @foreach ($allUser as $key => $item)
                                        <option value="{{ $item->id }}" {{old('user_id')==$item->id?'selected':false}}>{{ $item->id }}</option>
                                    @endforeach
                                </select>
                                @error('price_sale')
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
            </main>
            @include('parts.backend.footer')