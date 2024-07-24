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
                    <a href="{{route('admin.product.add')}}" class="btn btn-primary mb-3">Thêm sản phẩm</a>
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-3">
                                <select name="product_category" id="" class="form-control">
                                    <option value="0">Danh mục điện thoại</option>
                                    @foreach ($allCate as $key => $item)
                                        <option value="{{ $item->id }}"{{old('product_category')==$item->id?'selected':false}}>{{ $item->name }}</option>
                                    @endforeach
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
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Ảnh</th>
                                <th>Danh mục</th>
                                <th>Số lượng</th>
                                <th>Mô tả ngắn</th>
                                <th>Mô tả</th>
                                <th>Thời gian tạo</th>
                                <th>Thời gian cập nhập</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($allProduct))
                            @foreach ($allProduct as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->price}}</td>
                                <td><img src="{{asset($item->image)}}" alt="" height="200px"></td>
                                <td>{{$item->product_category}}</td>
                                <td>{{$item->quanlity}}</td>
                                <td>{{$item->short_description}}</td>
                                <td >{{$item->description}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td><a href="{{route('admin.product.edit',['id' => $item->id])}}" class="btn btn-warning sm-2">Sửa</a></td>
                                <td><a href="{{route('admin.product.delete',['id'=>$item->id])}}" class="btn btn-danger sm-2" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a></td>   
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
                        {{$allProduct->links()}}
                      </div>
                </div>
            </div>
        </div>
            </main>
            @include('parts.backend.footer')