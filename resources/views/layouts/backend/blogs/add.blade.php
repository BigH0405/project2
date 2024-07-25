    @include('parts.backend.header')
    <div id="layoutSidenav">
        @include('parts.backend.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="text-center mb-3 mt-3">{{$title}}</h1>
                    <a href="{{route('admin.blog.index')}}" class="btn btn-warning mb-3">Quay về</a>
                    <form action="" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Mô tả</label>
                                    <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Nhập mô tả...">
                                    @if ($errors->has('title'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">Ảnh</label>
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Lượt xem </label>
                                    <input type="text" class="form-control" name="views" value="{{old('views')}}" placeholder="Nhập lượt xem...">
                                    @if ($errors->has('views'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('views') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Danh mục bài viết</label>
                                    <select name="blog_id" id="" class="form-control">
                                        <option value="0">Chọn danh mục</option>
                                        @if (!empty($allCate))
                                        @foreach ($allCate as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('blog_id'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('blog_id') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Tác giả </label>
                                    <select name="user_id" id="" class="form-control">
                                        <option value="0">Chọn tác giả</option>
                                        @if (!empty($allUser))
                                        @foreach ($allUser as $item)
                                        <option value="{{$item->id}}">{{$item->fullname}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('user_id'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('user_id') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Mô tả ngắn </label>
                                    <input type="text" class="form-control" name="short_description" value="{{old('short_description')}}" placeholder="Nhập mô tả ngắn...">
                                    @if ($errors->has('short_description'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('short_description') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for=""> Mô tả </label>
                                    <textarea name="description" cols="12" rows="8" class="form-control" value="{{ old('description') }}" placeholder="Nhập mô tả..."></textarea>
                                    @if ($errors->has('description'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3">
                            <button class="btn btn-success" type="submit">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
            </main>
            @include('parts.backend.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('backend/js/scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('backend/assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('backend/assets/demo/chart-bar-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('backend/js/datatables-simple-demo.js')}}"></script>
</body>

</html>