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
                            <input type="text" name="title" class="form-control" placeholder="Nhập mô tả bài viết..." value="{{old('title') ?? $saleDetails->title}}">
                            @error('title')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Hình Ảnh</label>
                            <input type="text" name="image" class="form-control" placeholder="Nhập hình ảnh..." value="{{old('image')?? $saleDetails->image}}">
                            @error('image')
                            <span style="color: red">{{$message}}</span>
                            @enderror 
                        </div>
                        <div class="col-6">
                            <label for="">Lượt xem </label>
                            <input type="text" name="views" class="form-control" placeholder="Lượt xem..." value="{{old('views')?? $saleDetails->views}}">
                            @error('views')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Mô tả ngắn </label>
                            <input type="text" name="short_description" class="form-control" placeholder="Nhập mô tả ngắn ..." value="{{old('short_description')?? $saleDetails->short_description}}">
                            @error('short_description')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Miêu tả </label>
                            <input type="text" name="description" class="form-control" placeholder="Nhập miêu tả..." value="{{old('description')?? $saleDetails->description}}">
                            @error('description')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                           <!-- Blade Template -->
                            <label for="">Ngày bắt đầu</label>
                            <input type="date" name="start_day" class="form-control" placeholder="Nhập ngày bắt đầu..."
                            value="{{ old('start_day')?? $saleDetails->start_day }}">
                            @error('start_day')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Ngày kết thúc</label>
                            <input type="date" name="end_day" class="form-control" value="{{old('end_day') ?? $saleDetails->end_day}}">
                            @error('end_day')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Trạng thái</label>
                            <select name="status" id="" class="form-control">
                              <option value="0" {{old('status')==0?'selected':false}}>Chưa kích hoạt</option>
                              <option value="1" {{old('status')==1?'selected':false}}>Kích hoạt</option>
                            </select>
                            @error('status')
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
        </main>
        @include('parts.backend.footer')