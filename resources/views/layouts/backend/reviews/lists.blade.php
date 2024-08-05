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
                                <th>Sản phẩm</th>
                                <th>Người dùng</th>                                
                                <th width="20%">Đánh giá </th>
                                <th>Thời gian tạo</th>
                                <th>Thời gian cập nhập</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($allReviews))
                            @foreach ($allReviews as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->Product ? $item->Product->name : 'Không có sản phẩm'}}</td>
                                <td>{{$item->User ? $item->User->fullname : 'Không có người dùng'}}</td>
                                <td >{{ Str::limit($item->message, 25) }}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                @can('update', App\Models\admin\Reviews::class)
                                <td><a href="{{route('admin.reviews.edit',['id' => $item->id])}}" class="btn btn-warning sm-2">Sửa</a></td>
                                @endcan
                                @can('delete',App\Models\admin\Reviews::class)
                                <td><a href="{{route('admin.reviews.delete',['id'=>$item->id])}}" class="btn btn-danger sm-2" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a></td>   
                                @endcan
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="13" class="text-center" style="color: red">Không có sản phẩm</td>
                              </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{$allReviews->links()}}
                      </div>
                </div>
            </div>
        </div>
    </div>
            </main>
            @include('parts.backend.footer')