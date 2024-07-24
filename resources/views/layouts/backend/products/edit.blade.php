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
                <a href="{{route('admin.product.index')}}" class="btn btn-warning mb-3">Quay về</a>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên mã giảm giá..." value="{{old('name') ?? $product->name}}">
                            @error('name')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Giá</label>
                            <input type="text" name="price" class="form-control" placeholder="Nhập số tiền giảm..." value="{{old('price')?? $product->price}}">
                            @error('price')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Ảnh</label>
                            <input type="file" name="image" class="form-control" placeholder="Nhập tên mã..."
                                value="{{ old('image') }}">
                            @error('image')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Danh mục sản phẩm</label>
                            <select name="product_category" id="" class="form-control">
                                @foreach ($allCate as $key => $item)
                                    <option value="{{ $item->id }}"{{old('product_category')?? $product->product_category==$item->id?'selected':false }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('product_category')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Số lượng</label>
                            <input type="text" name="quanlity" class="form-control" placeholder="Nhập số lượng..." value="{{old('quanlity')?? $product->quanlity}}">
                            @error('quanlity')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Mô tả ngắn</label>
                            <textarea name="short_description" cols="5" rows="1" class="form-control"
                                value="{{ old('short_description') ?? $product->short_description }}"></textarea>
                            @error('short_description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="">Mô tả</label>
                            <textarea name="description" cols="5" rows="1" class="form-control" value="{{ old('description') ?? $product->description}}"></textarea>
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
        </main>
        @include('parts.backend.footer')
