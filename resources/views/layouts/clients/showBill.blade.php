@include('parts.clients.header')

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Thông tin đơn hàng</h1>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <a style="color: white" href="{{route('clients.bills')}}"><button type="submit" class="btn btn-primary">Quay lại</button></a>
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Họ và tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Số tiền</th>
                            <th scope="col">Ngày đặt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $donHang->code }}</td>
                            <td>{{ $donHang->name }}</td>
                            <td>{{ $donHang->email }}</td>
                            <td>{{ $donHang->phone }}</td>
                            <td>{{ $donHang->address }}</td>
                            <td>{{ number_format($donHang->price, 0, '', '.') }}đ</td>
                            <td>{{ $donHang->created_at->format('d-m-Y') }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donHang->chiTietDonHang as $item)
                        @php
                            $sanPham = $item->sanPham; // Đây là sản phẩm liên quan
                        @endphp
                        <tr>
                            <td>{{ $sanPham->name }}</td> <!-- Hiển thị tên sản phẩm -->
                            <td>{{ $item->quanlity }}</td> <!-- Đảm bảo rằng bạn sử dụng đúng tên thuộc tính -->
                            <td>{{ number_format($item->price, 0, '', '.') }}đ</td>
                        </tr>
                    @endforeach                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->
@include('parts.clients.footer')
