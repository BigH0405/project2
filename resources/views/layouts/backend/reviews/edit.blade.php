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
                <a href="{{route('admin.reviews.index')}}" class="btn btn-warning mb-3">Quay về</a>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Họ và tên</label>
                            <input type="text" name="User->fullname" class="form-control" value="{{ old('User->fullname') ?? $reviews->User->fullname }}" disabled>
                            @error('User->fullname')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="product->title">Sản phẩm</label>
                            <input type="text" name="product->name" class="form-control" value="{{ old('product->name') ?? $reviews->product->name }}" disabled>
                            @error('product->name')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="messege">Đánh  giá </label>
                            <textarea name="messege" cols="12" rows="8" class="form-control">{{ old('messege') ?? $reviews->messege }}</textarea>
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
