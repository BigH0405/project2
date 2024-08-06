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
        @if(session('login'))
    <div class="alert alert-danger">
        {{ session('login') }}
    </div>
        @endif
        @if (session('msg'))
            <div class="alert alert-success">{{ session('msg') }}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-warning">{{ session('error') }}</div>
    @endif
        <div class="cart_inner">
            <form action="{{ route('clients.cart.update') }}" method="post">
                @csrf
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!@empty($cart))                                
                            @foreach ($cart as $key => $item)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="img/cart.jpg" alt="">
                                            </div>
                                            <div class="media-body">
                                                <h4>
                                                <a
                                                  style="color: black"  href="{{ route('clients.product_detail', $key) }}">{{ $item['name'] }}</a>
                                                <input type="hidden" name="cart[{{ $key }}][name]"
                                                    value="{{ $item['name'] }}"></h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>{{ number_format($item['price'], 0, '', '.') }}đ</h5>
                                        <input type="hidden" name="cart[{{ $key }}][price]"
                                            value="{{ $item['price'] }}">
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <input type="text" name="cart[{{ $key }}][quanlity]"
                                                value="{{ $item['quanlity'] ?? 1 }}" title="Quantity:"
                                                class="input-text qty" data-price="{{ $item['price'] }}"
                                                data-id="{{ $key }}">
                                            <button class="increase items-count" type="button"
                                                onclick="changeQuantity(this, 1)"><i
                                                    class="lnr lnr-chevron-up"></i></button>
                                            <button class="reduced items-count" type="button"
                                                onclick="changeQuantity(this, -1)"><i
                                                    class="lnr lnr-chevron-down"></i></button>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="total">
                                            {{ number_format($item['price'] * ($item['quanlity'] ?? 1), 0, '', '.') }}đ
                                        </h5>
                                    </td>
                                    <td><a href="#" class="lnr lnr-cross" onclick="removeItem(this)"></a></td>
                                </tr>
                            @endforeach
                            @else
                            <td>
                            <h4>Không có sản phẩm nào</h4>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                            @endif
                            <tr class="bottom_button">
                                <td>
                                    <button type="submit" class="gray_btn">Update Cart</button>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="cupon_text d-flex align-items-center">
                                        <input type="text" placeholder="Coupon Code">
                                        <a class="primary-btn" href="#">Apply</a>
                                        <a class="gray_btn" href="#">Close Coupon</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5 id="subTotal">{{ number_format($subTotal, 0, '', '.') }}đ</h5>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Shipping</h5>
                                </td>
                                <td>
                                    <h5 id="shipping">{{ number_format($shipping, 0, '', '.') }}đ</h5>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Total</h5>
                                </td>
                                <td>
                                    <h5 id="total">{{ number_format($total, 0, '', '.') }}đ</h5>
                                </td>
                            </tr>
                            <tr class="out_button_area">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="{{ route('clients.products') }}">Tiếp tục mua hàng</a>
                                        <a class="primary-btn" href="{{ route('clients.bill.create') }}">Thanh toán</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

<script>
    function changeQuantity(button, increment) {
        var input = button.parentNode.querySelector('input[name^="cart"]');
        var value = parseInt(input.value);
        value += increment;
        if (value < 1) {
            value = 1;
        }
        input.value = value;
        updateCart(input);
    }

    function updateCart(input) {
        var price = parseFloat(input.getAttribute('data-price'));
        var quantity = parseInt(input.value);
        var total = price * quantity;

        var totalElement = input.closest('tr').querySelector('.total');
        totalElement.textContent = total.toLocaleString() + 'đ';

        updateTotals();
    }

    function removeItem(button) {
        var row = button.closest('tr');
        row.remove();
        updateTotals();
    }

    function updateTotals() {
        var subTotal = 0;

        // Calculate subtotal
        document.querySelectorAll('input[name^="cart"]').forEach(function(input) {
            var price = parseFloat(input.getAttribute('data-price').replace(/,/g, ''));
            var quantity = parseInt(input.value);
            subTotal += price * quantity;
        });

        // Calculate shipping
        var shippingText = document.getElementById('shipping').textContent;
        var shipping = parseFloat(shippingText.replace(/,/g, '').replace('đ', '').trim());

        // Calculate total
        var total = subTotal + shipping;

        // Update DOM
        document.getElementById('subTotal').textContent = subTotal.toLocaleString() + 'đ';
        document.getElementById('total').textContent = total.toLocaleString() + 'đ';
    }


    document.addEventListener('DOMContentLoaded', function() {
        updateTotals();
    });
</script>

<!-- start footer Area -->

@include('parts.clients.footer')
