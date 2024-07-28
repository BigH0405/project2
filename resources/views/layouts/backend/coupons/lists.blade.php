    @include('parts.backend.header')
    <div id="layoutSidenav">
        @include('parts.backend.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="text-center mb-3 mt-3">{{$title}}</h1>
                    @if (session('msg'))
                    <div class="alert alert-success">{{session('msg')}}</div>
                    @endif
                    @if (session('msg_warning'))
                    <div class="alert alert-danger">{{session('msg_warning')}}</div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu</div>
                    @endif
                    <a href="{{route('admin.coupons.add')}}" class="btn btn-primary mb-3">Thêm mã giảm giá</a>
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-4">
                                <input type="search" name="keywords" id="" class="form-control mb-3" placeholder="Nhập từ khóa tìm kiếm..." value="{{request()->keywords}}">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-outline-primary">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên mã</th>
                                <th>Giảm giá</th>
                                <th>Số lượng</th>
                                <th>Người dùng</th>
                                <th>Ngày bắt đâu</th>
                                <th>Ngày kết thúc</th>
                                <th>Thời gian tạo</th>
                                <th>Thời gian cập nhập</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($allCoupon))
                            @foreach ($allCoupon as $key =>$item)
                             <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->discount}}</td>
                                <td>{{$item->quantily}}</td>
                                <td>{{$item->Users ?$item->Users->fullname:"Không có khách hàng"}}</td>
                                <td>{{$item->start_day}}</td>
                                <td>{{$item->end_day}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td><a href="{{route('admin.coupons.edit',['id'=>$item->id])}}" class="btn btn-warning sm-2">Sửa</a></td>
                                <td><a href="{{route('admin.coupons.delete',['id'=>$item->id])}}" class="btn btn-danger sm-2" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a></td>   
                            </tr>   
                            @endforeach
                            @else
                            <tr>
                                <td colspan="11" class="text-center">Không có mã giảm giá nào</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{$allCoupon->links()}}
                      </div>
                </div>
            </div>
            </div>
        </div>
            </main>
            @include('parts.backend.footer')