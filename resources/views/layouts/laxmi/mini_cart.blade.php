    <div class="offCanvas__minicart product_data">
        <div class="minicart__header  ">
            <div class="minicart__header--top d-flex justify-content-between align-items-center">
                <h3 class="minicart__title"> Shopping Cart</h3>
                <button class="minicart__close--btn" aria-label="minicart close btn" data-offcanvas>
                    <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="32" d="M368 368L144 144M368 144L144 368" />
                    </svg>
                </button>
            </div>
            @if ($cartitems->count() > 0)
                <p class="minicart__header--desc">The Beauty and Cosmetic products are limited</p>
            @endif
        </div>



        @php $total = 0; @endphp
        @if ($cartitems->count() > 0)
            <div class="minicart__product ">
                @foreach ($cartitems as $items)
                    {{-- @php
                $category = App\Models\Category::latest()->get();
            @endphp --}}
                    {{-- {{$category->slug}} --}}
                    {{-- href="/category/{{ $prods->category->slug }}/{{ $prods->slug }}" --}}
                    <div class="minicart__product--items d-flex">
                        <input type="hidden" class="prod_id" value="{{ $items->prod_id }}">
                        <div class="minicart__thumb">
                            {{-- /category/necklace/{{ $items->products->slug }} --}}

                            <a href="{{ url('category/' . $items->products->category->slug . '/' . $items->products->id) }}"
                                class="display-block"><img
                                    src="{{ asset('assets/uploads/products/' . $items->products->image) }}"
                                    alt="prduct-img"></a>
                            <span class="product__thumbnail--quantity">{{ $items->products->prod_qty }}</span>
                        </div>

                        @php
                        $perc =
                            ($items->products->original_price - $items->products->selling_price) /
                            $items->products->original_price;
                        @endphp
                        @php
                            $discount = $items->products->selling_price < $items->products->original_price;
                        @endphp


                        <div class="minicart__text">
                            <h4 class="minicart__subtitle"><a
                                    href="product-details.html">{{ $items->products->name }}

                                    {{-- @if ($discount)
                                     <span class="product__badge">{{ round($perc * 100) }}% off</span>
                                    @endif --}}
                                </a></h4>


                            <div class="minicart__price">
                                <span class="minicart__current--price">Rs.{{ $items->products->selling_price }}</span>
                                @if ($discount)
                                <span class="minicart__old--price">Rs.{{ $items->products->original_price }}</span>
                                @endif

                            </div>
                            <div class="minicart__text--footer d-flex align-items-center">
                                <div class="quantity__box minicart__quantity product_data_qty_update"
                                    id="minicart_aft_del">
                                    <input type="hidden" value="{{ $items->prod_id }}" class="prod_id_qty_update">

                                    <button type="button" class="quantity__value changeQuantity decrease-btn"
                                        aria-label="quantity value" onclick="return false;">-</button>
                                    <label>
                                        <input type="text" class="quantity__number qty-input"
                                            value="{{ $items->prod_qty }}" data-counter />
                                    </label>

                                    @if ($items->products->qty >= $items->prod_qty)
                                        <button type="button" class="quantity__value changeQuantity increase-btn"
                                            aria-label="quantity value" onclick="return false;">+</button>
                                    @else
                                        <button type="button" disabled
                                            class="quantity__value changeQuantity increase-btn"
                                            aria-label="quantity value" onclick="return false;">+</button>
                                    @endif

                                    <div id="new_price_update">
                                        @php $total += $items->products->selling_price * $items->prod_qty @endphp
                                    </div>

                                </div>
                                <div class="cartdelete">
                                    <button class="minicart__product--remove delete-cart-item"
                                        type="button">Remove</button>
                                </div>
                            </div>
                        </div>

                        {{-- @php $total += $items->products->selling_price * $items->prod_qty  @endphp --}}


                    </div>
                @endforeach


            </div>

            <div class="minicart__amount total_amt">
                <div class="minicart__amount_list d-flex justify-content-between">
                    <span>Sub Total:</span>
                    <span><b>Rs.{{ $total }}</b></span>
                </div>
                <div class="minicart__amount_list d-flex justify-content-between">
                    <span>Total:</span>
                    <span><b>Rs.{{ $total }}</b></span>
                </div>
            </div>
            <div class="minicart__conditions text-center">
                <input class="minicart__conditions--input" id="terms" type="checkbox">
                <label class="minicart__conditions--label" for="accept">I agree with the <a
                        class="minicart__conditions--link" href="{{ url('privacy_policies') }}">Privacy
                        Policy</a></label>
            </div>
            <div class="minicart__button d-flex justify-content-center">
                <a class="primary__btn minicart__button--link" onclick="return validate()">View cart</a>
                <a class="primary__btn minicart__button--link" onclick="return validatecheckout()">Checkout</a>
            </div>
        @else
            <div class="card-body">
                <h4>There are no items in your cart</h4>
            </div>
            <div class="minicart__button d-flex justify-content-center">
                {{-- <a class="primary__btn minicart__button--link" href="">View cart</a> --}}
                <a class="primary__btn minicart__button--link" href="{{ url('/') }}">Continue Shopping</a>
            </div>
        @endif
    </div>


    <script>
        function validate() {
            if (document.getElementById('terms').checked) {
                window.location.href = "/cart";
                // alert(response.statuscode);


                // swal(response.status)

                // .then((value)=>{
                //     window.location.href="/login";
                // });
            } else {
                // alert('bye');
                //   swal(response.status)
                alert('Please Accepts Privacy Policy');
            }
        }

        function validatecheckout() {
            if (document.getElementById('terms').checked) {
                // alert('hi');
                window.location.href = "/checkout";
            } else {
                // alert('bye');
                //   swal(response.status)
                alert('Please Accepts Privacy Policy');
            }
        }
    </script>
