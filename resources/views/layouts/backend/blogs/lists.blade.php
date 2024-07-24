    @include('parts.backend.header')
    <div id="layoutSidenav">
        @include('parts.backend.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="text-center mb-3 mt-3">{{$title}}</h1>
                    <a href="{{route('admin.blog.add')}}" class="btn btn-primary mb-3">Thêm bài viết </a>
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-3">
                                <select name="" id="" class="form-control">
                                    <option value="0">Danh mục bài viết </option>
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
                                <th>Mô tả</th>
                                <th>Hình ảnh</th>
                                <th>Lượt xem</th>
                                <th>Người dùng</th>
                                <th>Danh mục</th>
                                <th>Mô tả ngắn</th>
                                <th>Miêu tả </th>
                                <th>Thời gian tạo</th>
                                <th>Thời gian cập nhập</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($allBlog))
                            @foreach ($allBlog as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->image}}</td>
                                <td>{{$item->views}}</td>
                                <td>{{$item->user_id}}</td>
                                <td>{{$item->blog_id}}</td>
                                <td>{{$item->short_description}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td><button class="btn btn-warning sm-2">Sửa</button></td>
                                <td><button class="btn btn-danger sm-2">Xóa</button></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="13" class="text-center" style="color: red">Không có người dùng</td>
                              </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
            </main>
            @include('parts.backend.footer')
   