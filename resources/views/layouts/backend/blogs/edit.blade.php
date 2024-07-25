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
                <a href="{{route('admin.blog.index')}}" class="btn btn-warning mb-3">Quay về</a>
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="">Mô tả bài viết </label>
                            <input type="text" name="title" class="form-control" placeholder="Nhập mô tả bài viết..." value="{{old('title')?? $Blog->title}}">
                            @error('title')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="image">Ảnh</label>
                            <input type="file" name="image" class="form-control">
                            @if (!empty($Blog->image))
                                <div class="mt-2">
                                    <img src="{{ asset($Blog->image) }}" alt="Ảnh sản phẩm" style="width: 100px;">
                                </div>
                            @endif
                            @error('image')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Lượt xem </label>
                            <input type="text" name="views" class="form-control" placeholder="Lượt xem..." value="{{old('views')?? $Blog->views}}">
                            @error('views')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Danh mục bài viết</label>
                                <input type="text" class="form-control" name="blog_id" value="{{old('blog_id') ?? $Blog->blog_id}}">
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
                                    @if(!empty($allUser))
                                    @foreach ($allUser as $item)
                                    <option value="{{$item->id}}" {{old('user_id')==$item->id || $Blog->user_id==$item->id?'selected':false}}>{{$item->fullname}}</option>
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
                            <label for="short_description">Mô tả ngắn</label>
                            <textarea name="short_description" cols="5" rows="1" class="form-control">{{ old('short_description') ?? $Blog->short_description }}</textarea>
                            @error('short_description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="description">Mô tả</label>
                            <textarea name="description" cols="12" rows="8" class="form-control">{{ old('description') ?? $Blog->description }}</textarea>
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-success" type="submit">Cập nhập</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
            </div>
        </div>
        </main>
        @include('parts.backend.footer')