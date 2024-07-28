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
                    {{-- <a href="{{route('admin.product.add')}}" class="btn btn-primary mb-3">Thêm sản phẩm</a> --}}
                    <form action="" method="GET">
                        <div class="row">
                            {{-- <div class="col-3">
                                <select name="product_category" id="" class="form-control">
                                    <option value="0">Danh mục điện thoại</option>
                                    @foreach ($allCate as $key => $item)
                                        <option value="{{ $item->id }}"{{old('product_category')==$item->id?'selected':false}}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
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
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Tin nhắn </th>
                                <th>User_id</th>
                                <th>Thời gian tạo</th>
                                <th>Thời gian cập nhập</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($allContacts))
                            @foreach ($allContacts as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->fullname}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->message}}</td>
                                <td >{{$item->user_id}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td><a href="{{route('admin.contacts.edit',['id' => $item->id])}}" class="btn btn-warning sm-2">Sửa</a></td>
                                <td><a href="{{route('admin.contacts.delete',['id'=>$item->id])}}" class="btn btn-danger sm-2" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a></td>   
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
                        {{$allContacts->links()}}
                      </div>
                </div>
            </div>
        </div>
    </div>
            </main>
            @include('parts.backend.footer')