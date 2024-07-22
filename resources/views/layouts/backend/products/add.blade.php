<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('backend/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body class="sb-nav-fixed">
    @include('parts.backend.header')
    <div id="layoutSidenav">
        @include('parts.backend.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="text-center mb-3 mt-3">{{ $title }}</h1>
                    @if (session('msg_warning'))
                        <div class="alert alert-danger">{{ session('msg_warning') }}</div>
                    @endif
                    <a href="{{ route('admin.product.index') }}" class="btn btn-warning mb-3">Quay về</a>
                    <form action="" method="POST">
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
                                <label for="">Giá sale</label>
                                <select name="price_sale" id="" class="form-control">
                                    @foreach ($allPromo as $key => $item)
                                        <option value="{{ $item->id }}" {{old('price_sale')==$item->id?'selected':false}}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('price_sale')
                                    <span style="color: red">{{ $message }}</span>
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
                                        <option value="{{ $item->id }}"{{old('product_category')==$item->id?'selected':false}}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_category')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Số lượng</label>
                                <input type="text" name="quantity" class="form-control"
                                    value="{{ old('quantity') }}">
                                @error('quantity')
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
            </main>
            @include('parts.backend.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('backend/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('backend/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('backend/js/datatables-simple-demo.js') }}"></script>
</body>

</html>
