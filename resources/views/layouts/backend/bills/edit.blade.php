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
                @if ($errors->any())
                <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu</div>
                @endif
                <a href="{{route('admin.bills.index')}}" class="btn btn-warning mb-3">Quay về</a>
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="">
                            <label for="">Tên danh mục</label>
                            <input type="text" name="code" class="form-control" placeholder="Nhập tên danh mục bài viết..." value="{{old('code') ?? $bills->code}}">
                            @error('code')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="">
                            <label for=""> Mô tả </label>
                            <input type="text" name="name" class="form-control" placeholder="Nhập mô tả bài viết..." value="{{old('name') ?? $bills->name}}">
                            @error('name')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="">
                            <label for=""> Mô tả </label>
                            <input type="text" name="email" class="form-control" placeholder="Nhập mô tả bài viết..." value="{{old('email') ?? $bills->email}}">
                            @error('email')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="">
                            <label for=""> Mô tả </label>
                            <input type="text" name="phone" class="form-control" placeholder="Nhập mô tả bài viết..." value="{{old('phone') ?? $bills->phone}}">
                            @error('phone')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="">
                            <label for=""> Mô tả </label>
                            <input type="text" name="price" class="form-control" placeholder="Nhập mô tả bài viết..." value="{{old('price') ?? $bills->price}}">
                            @error('price')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="">
                            <label for=""> Mô tả </label>
                            <textarea name="messege" id="" cols="30" rows="10" placeholder="Nhập mô tả bài viết..." class="form-control" >{{old('messege') ?? $bills->messege}}</textarea>
                            @error('messege')
                            <span style="color: red">{{$message}}</span>
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

