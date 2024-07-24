
    @include('parts.backend.header')
    <div id="layoutSidenav">
        @include('parts.backend.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="text-center mb-3 mt-3">{{ $title }}</h1>
                    @if (session($errors->all()))
                    <div class="alert alert-danger">Dữ liệu nhập vào sai</div>
                    @endif
                    <a href="{{ route('admin.product.index') }}" class="btn btn-warning mb-3">Quay về</a>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Nhập tên sản phẩm..." value="{{ old('name') }}">
                                @error('name')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Giá</label>
                                <input type="text" name="price" class="form-control" placeholder="Nhập giá..."
                                    value="{{ old('price') }}">
                                @error('price')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Ảnh</label>
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Danh mục sản phẩm</label>
                                <select name="product_category" id="" class="form-control">
                                    @foreach ($allCate as $key => $item)
                                        <option value="{{ $item->id }}"{{old('product_category')==$item->id?'selected':false}}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_category')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Số lượng</label>
                                <input type="text" name="quanlity" class="form-control"
                                    value="{{ old('quanlity') }}">
                                @error('quanlity')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Mô tả ngắn</label>
                                <textarea name="short_description" cols="5" rows="1" class="form-control"
                                    value="{{ old('short_description') }}"></textarea>
                                @error('short_description')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="">Mô tả</label>
                                <textarea name="description" cols="5" rows="1" class="form-control" value="{{ old('description') }}"></textarea>
                                @error('description')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-success" type="submit">Thêm mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            </div>
            </main>
            @include('parts.backend.footer')
