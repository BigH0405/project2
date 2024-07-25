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
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm..." value="{{ old('name') ?? $product->name }}">
                            @error('name')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="price">Giá</label>
                            <input type="text" name="price" class="form-control" placeholder="Nhập giá sản phẩm..." value="{{ old('price') ?? $product->price }}">
                            @error('price')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                            <div class="col-6">
                                <label for="image">Ảnh</label>
                                <input type="file" name="image" class="form-control" placeholder="Chọn ảnh mới...">
                                @if (!empty($product->image))
                                    <div class="mt-2">
                                        <img src="{{ asset($product->image) }}" alt="Ảnh sản phẩm" style="width: 100px;">
                                    </div>
                                @endif
                                @error('image')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        <div class="col-6">
                            <label for="product_category">Danh mục sản phẩm</label>
                            <select name="product_category" id="product_category" class="form-control">
                                @foreach ($allCate as $item)
                                    <option value="{{ $item->id }}" {{ old('product_category') == $item->id || $product->product_category == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_category')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="quanlity">Số lượng</label>
                            <input type="text" name="quanlity" class="form-control" placeholder="Nhập số lượng..." value="{{ old('quanlity') ?? $product->quanlity }}">
                            @error('quanlity')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="short_description">Mô tả ngắn</label>
                            <textarea name="short_description" cols="5" rows="1" class="form-control">{{ old('short_description') ?? $product->short_description }}</textarea>
                            @error('short_description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="description">Mô tả</label>
                            <textarea name="description" cols="12" rows="8" class="form-control">{{ old('description') ?? $product->description }}</textarea>
                            @error('description')
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
