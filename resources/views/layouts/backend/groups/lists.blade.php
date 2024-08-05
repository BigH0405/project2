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
                @can('create',App\Models\admin\Groups::class)
                <a href="{{route('admin.group.add')}}" class="btn btn-primary mb-3">Thêm mới</a>
                @endcan
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
                            <th>Tên nhóm</th>
                            <th>Phân quyền</th>
                            <th>Thời gian tạo</th>
                            <th>Thời gian cập nhập</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($allGroups))
                        @foreach ($allGroups as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td><a href="{{ route('admin.group.permission',['id' => $item->id])}}" class="btn btn-primary">Phân quyền</a></td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            @can('update', App\Models\admin\Groups::class)
                            <td><a href="{{route('admin.group.edit',['id' => $item->id])}}" class="btn btn-warning sm-2">Sửa</a></td>
                            @endcan
                            @can('delete', App\Models\admin\Groups::class)
                            <td><a href="{{route('admin.group.delete',['id'=>$item->id])}}" class="btn btn-danger sm-2" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a></td>   
                            @endcan
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center" style="color: red">Không có sản phẩm</td>
                          </tr>
                        @endif
                    </tbody>
                </table>
                <div class="float-right">
                    {{$allGroups->links()}}
                  </div>
            </div>
        </div>
    </div>
</div>
        </main>
        @include('parts.backend.footer')