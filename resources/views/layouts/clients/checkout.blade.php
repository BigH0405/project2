@include('parts.clients.header')

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Checkout</h1>
                <nav class="d-flex align-items-center">
                    {{-- <a href="{{ route('home') }}">Home<span class="lnr lnr-arrow-right"></span></a> --}}
                    <a href="single-product.html">Checkout</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <form class="row contact_form" action="{{route('clients.bill.store')}}" method="post" novalidate="novalidate">
                @csrf
            <div class="row"> 
                <div class="col-lg-8">
                    <h3>Billing Details</h3>
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="col-md-12 form-group p_star">
                            <label for="">Tên người nhận</label>
                            <input type="text" class="form-control" id="first" name="name" value="{{ Auth::user()->fullname }}">
                        </div>

                        <div class="col-md-6 form-group p_star">
                            <label for="">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <label for="">email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <span class="#">Địa chỉ nhận hàng</span>
                            <input type="text" class="form-control" id="add1" name="address" value="{{ Auth::user()->address }}">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <h3>Ghi chú</h3>
                            </div>
                            <textarea class="form-control" name="messege" id="message" rows="1" ></textarea>
                        </div>
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li><a href="#">Product <span>Total</span></a></li>
                            @foreach($cart as $key => $item)
                                <li><a href="#">{{ $item['name'] }} <span class="middle">x {{ $item['quanlity'] }}</span> <span class="last">{{ number_format($item['price']*$item['quanlity'], 0, '', '.') }}đ</span></a></li>
                            @endforeach
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Subtotal <span>{{ number_format($subTotal, 0, '', '.') }}đ</span>
                            <li><a href="#">Shipping <span>{{ number_format($shipping, 0, '', '.') }}đ</span></a></li>
                            <li><a href="#">Total <span>{{ number_format($total, 0, '', '.') }}đ</span>
                            <input type="hidden" name="price"  value="{{$total}}">
                            </a></li>
                        </ul>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="f-option5" name="payment_method" >
                                <label for="f-option5">Thanh toán khi giao hàng</label>
                                <div class="check"></div>
                            </div>
                            <p>Thanh toán bằng tiền mặt khi giao hàng.</p>
                        </div>
                        <div class="creat_account">
                            <input type="checkbox" id="f-option4" name="terms_conditions">
                            <label for="f-option4">I’ve read and accept the </label>
                            <a href="#">terms & conditions*</a>
                        </div>
                      <button type="submit" class="primary-btn" >Proceed to Paypal</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

<!-- start footer Area -->
@include('parts.clients.footer')
