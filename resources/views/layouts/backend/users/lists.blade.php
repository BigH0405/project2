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
                <a href="{{route('admin.user.add')}}" class="btn btn-primary mb-3">Thêm mới</a>
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-3">
                            <select name="group_id" class="form-control">
                                <option value="0">Danh mục nhóm</option>
                                @foreach ($allGroup as $item)
                                    <option value="{{ $item->id }}" {{request()->group_id==$item->id?'selected':false}}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-3">
                            <select name="status" id="" class="form-control">
                              <option value="0">Tất cả trạng thái</option>
                              <option value="active" {{request()->status=='active'?'selected':false}}>Kích hoạt</option>
                              <option value="inactive" {{request()->status=='inactive'?'selected':false}}>Chưa kích hoạt</option>
                            </select>
                          </div>
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
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Mật khẩu</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Chức vụ</th>
                            <th>Thời gian tạo</th>
                            <th>Thời gian cập nhập</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($allUser))
                        @foreach ($allUser as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->fullname}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->password}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->address}}</td>
                            <td>{!!$item->status==0?'<button class="btn btn-warning btn-sm">Chưa kích hoạt</button>':'<button class="btn btn-success btn-sm">Kích hoạt</button>'!!}</td>
                            <td>{{$item->Group ? $item->Group->name : 'Không có nhóm'}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td><a href="{{route('admin.user.edit',['id' => $item->id])}}" class="btn btn-warning sm-2">Sửa</a></td>
                            <td><a href="{{route('admin.user.delete',['id'=>$item->id])}}" class="btn btn-danger sm-2" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a></td>   
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="12" class="text-center" style="color: red">Không có sản phẩm</td>
                          </tr>
                        @endif
                    </tbody>
                </table>
                <div class="float-right">
                    {{$allUser->links()}}
                  </div>
            </div>
        </div>
    </div>
</div>
        </main>
        @include('parts.backend.footer')