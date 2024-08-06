
@include('parts.clients.header')

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Ngày đặt</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donHangs as $item)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/cart.jpg" alt="">
                                        </div>
                                        <div class="media-body">
                                            <a style="color: black" href="{{route('clients.bills.show',$item->id)}}"><h3>{{$item->code}}</h3></a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>{{$item->created_at->format('d-m-Y')}}</h5>
                                </td>
                                <td>
                                    <h5>{{ number_format($item->price, 0, '', '.') }}đ</h5>
                                </td>
                                <td>
                                    <h4>Đang xử lý </h4>
                                </td>
                                <td>
                                    <a style="color: black" href="{{route('clients.bills.show',$item->id)}}"><button style="border: none" class="primary-btn">Xem chi tiết</button></a>
                                </td>

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
