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
                    <a href="{{route('admin.blog.index')}}" class="btn btn-warning mb-3">Quay về</a>
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="title">Mô tả</label>
                                    <input type="text" class="form-control" id="title" name="name" required value="{{old('title')}}">
                                    @if ($errors->has('title'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="image"> Hình ảnh </label>
                                    <input type="text" class="form-control" id="image" name="image" required value="{{old('image')}}">
                                    @if ($errors->has('image'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('image') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="views"> Lượt xem </label>
                                    <input type="text" class="form-control" id="views" name="views" required value="{{old('views')}}">
                                    @if ($errors->has('views'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('views') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="short_description"> Mô tả ngắn </label>
                                    <input type="text" class="form-control" id="short_description" name="short_description" required value="{{old('short_description')}}">
                                    @if ($errors->has('short_description'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('short_description') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="description"> Miêu tả </label>
                                    <input type="text" class="form-control" id="description" name="description" required value="{{old('description')}}">
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
            </main>
            @include('parts.backend.footer')
   