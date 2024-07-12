<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{$title}}</title>
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
                    @if (session('msg_warning'))
                    <div class="alert alert-danger">{{session('msg_warning')}}</div>
                    @endif
                    <a href="{{route('admin.sale.index')}}" class="btn btn-warning mb-3">Quay về</a>
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="">Tên mã</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên mã giảm giá..." value="{{old('name') ?? $saleDetails->name}}">
                                @error('name')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Giảm giá</label>
                                <input type="text" name="discount" class="form-control" placeholder="Nhập số tiền giảm..." value="{{old('discount')?? $saleDetails->discount}}">
                                @error('discount')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Số lượng</label>
                                <input type="text" name="quantity" class="form-control" placeholder="Nhập số lượng..." value="{{old('quantity')?? $saleDetails->quantity}}">
                                @error('quantity')
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