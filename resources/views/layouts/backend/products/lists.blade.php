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
    <link href="{{asset('backend/css/styles.css')}}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body class="sb-nav-fixed">
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
                    <a href="{{route('admin.product.add')}}" class="btn btn-primary mb-3">Thêm sản phẩm</a>
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-3">
                                <select name="product_category" id="" class="form-control">
                                    <option value="0">Danh mục điện thoại</option>
                                    @foreach ($allCate as $key => $item)
                                        <option value="{{ $item->id }}"{{old('product_category')==$item->id?'selected':false}}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="price_sale" id="" class="form-control">
                                    <option value="0">Danh mục giảm giá</option>
                                    @foreach ($allPromo as $key => $item)
                                    <option value="{{ $item->id }}" {{old('price_sale')==$item->id?'selected':false}}>{{ $item->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <input type="search" name="keywords" id="" class="form-control mb-3" placeholder="Nhập từ khóa tìm kiếm..." value="{{request()->keywords}}">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-outline-primary">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Giảm giá</th>
                                <th>Ảnh</th>
                                <th>Danh mục</th>
                                <th>Số lượng</th>
                                <th>Mô tả ngắn</th>
                                <th>Mô tả</th>
                                <th>Thời gian tạo</th>
                                <th>Thời gian cập nhập</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($allProduct))
                            @foreach ($allProduct as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->price_sale}}</td>
                                <td>{{$item->image}}</td>
                                <td>{{$item->product_category}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->short_description}}</td>
                                <td >{{$item->description}}</td>
                                <td>{{$item->create_at}}</td>
                                <td>{{$item->update_at}}</td>
                                <td><a href="{{route('admin.product.edit',['id' => $item->id])}}" class="btn btn-warning sm-2">Sửa</a></td>
                                <td><a href="{{route('admin.product.delete',['id'=>$item->id])}}" class="btn btn-danger sm-2" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a></td>   
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="13" class="text-center" style="color: red">Không có sản phẩm</td>
                              </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{$allProduct->links()}}
                      </div>
                </div>
            </main>
            @include('parts.backend.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('backend/js/scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('backend/assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('backend/assets/demo/chart-bar-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('backend/js/datatables-simple-demo.js')}}"></script>
</body>

</html>