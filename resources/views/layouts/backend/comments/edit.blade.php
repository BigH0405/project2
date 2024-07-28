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
                <a href="{{route('admin.comments.index')}}" class="btn btn-warning mb-3">Quay về</a>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Họ và tên</label>
                            <input type="text" name="User->fullname" class="form-control" placeholder="Nhập tên sản phẩm..." value="{{ old('User->fullname') ?? $comments->User->fullname }}" disabled>
                            @error('User->fullname')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="Blog->title">Bài viết</label>
                            <input type="text" name="Blog->title" class="form-control" placeholder="Nhập giá sản phẩm..." value="{{ old('Blog->title') ?? $comments->Blog->title }}" disabled>
                            @error('Blog->title')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="messege">Bình luận</label>
                            <textarea name="messege" cols="12" rows="8" class="form-control">{{ old('messege') ?? $comments->messege }}</textarea>
                            @error('messege')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-success" type="submit">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        @include('parts.backend.footer')
    </div>
</div>
