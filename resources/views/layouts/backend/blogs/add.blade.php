    @include('parts.backend.header')
    <div id="layoutSidenav">
        @include('parts.backend.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="text-center mb-3 mt-3">{{$title}}</h1>
                    <a href="{{route('admin.blog.index')}}" class="btn btn-warning mb-3">Quay về</a>
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Mô tả</label>
                                    <input type="text" class="form-control" name="title" value="{{old('title')}}">
                                    @if ($errors->has('title'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for=""> Hình ảnh </label>
                                    <input type="text" class="form-control" name="image" value="{{old('image')}}">
                                    @if ($errors->has('image'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('image') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for=""> Lượt xem </label>
                                    <input type="text" class="form-control" name="views" value="{{old('views')}}">
                                    @if ($errors->has('views'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('views') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for=""> Mô tả ngắn </label>
                                    <input type="text" class="form-control" name="short_description" value="{{old('short_description')}}">
                                    @if ($errors->has('short_description'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('short_description') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for=""> Miêu tả </label>
                                    <input type="text" class="form-control" name="description" value="{{old('description')}}">
                                    @if ($errors->has('description'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Danh mục bài viết</label>
                                    <input type="text" class="form-control" name="blog_id" value="{{old('blog_id')}}">
                                    @if ($errors->has('blog_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('blog_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for=""> Tác giả </label>
                                    <input type="text" class="form-control" name="user_id" value="{{old('user_id')}}">
                                    @if ($errors->has('user_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('user_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        <div class="mt-3">
                            <button class="btn btn-success" type="submit">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </main>
            @include('parts.backend.footer')