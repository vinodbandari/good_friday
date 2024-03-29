<div class="checkout__page--area section--padding checkout_details">
    <div class="container">
        <form action="{{ url('place-order') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <div class="main checkout__mian">

                        <div class="checkout__content--step section__contact--information">

                            <div
                                class="checkout__section--header d-flex align-items-center justify-content-between mb-25">
                                <h2 class="checkout__header--title h3">Contact information</h2>
                                {{-- <p class="layout__flex--item">
                                    Already have an account?
                                    <a class="layout__flex--item__link" href="{{ route('login') }}">Log in</a>
                                </p> --}}
                            </div>
                            <div class="customer__information">
                                {{-- Email or Phone --}}
                                <div class="checkout__email--phone mb-12">
                                    <label>
                                        <input class="checkout__input--field border-radius-5"
                                            value="{{ Auth::user()->email }}" name="email" placeholder="Email"
                                            type="text" >
                                    </label>
                                </div>
                                {{-- <div class="checkout__checkbox">
                                    <input class="checkout__checkbox--input" id="check1" type="checkbox">
                                    <span class="checkout__checkbox--checkmark"></span>
                                    <label class="checkout__checkbox--label" for="check1">
                                        Email me with news and offers</label>
                                </div> --}}
                            </div>

                        </div>

                        {{-- B I L L I N G    D E T A I L S------------------------------------------------------------------ --}}
                        <div class="checkout__content--step section__shipping--address">
                            <div class="checkout__section--header mb-25">
                                <h2 class="checkout__header--title h3">Billing Details</h2>
                            </div>
                            <div class="section__shipping--address__content">
                                <div class="row">

                                    {{-- First Name --}}
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                        <div class="checkout__input--list ">
                                            <label class="checkout__input--label mb-10" for="input1">Fist Name <span
                                                    class="checkout__input--label__star">*</span></label>

                                                    @if(Auth::user()->name == '')
                                                    <input class="checkout__input--field border-radius-5"
                                                    value="{{ old('name') }}" name="name"
                                                    placeholder="First name" id="input6" type="text" >
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                    @else

                                            <input class="checkout__input--field border-radius-5"
                                                value="{{ Auth::user()->name }}" name="fname"
                                                placeholder="First name" id="input1" type="text"
                                                >
                                                @error('fname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                @endif
                                        </div>
                                    </div>

                                    {{-- Last Name --}}
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-10" for="input2">Last Name <span
                                                    class="checkout__input--label__star">*</span></label>

                                                    @if(Auth::user()->lname == '')
                                                <input class="checkout__input--field border-radius-5"
                                                value="{{ old('lname') }}" name="lname"
                                                placeholder="Last name" id="input6" type="text" >
                                                @error('lname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                @else

                                            <input class="checkout__input--field border-radius-5" name="lname"
                                                value="{{ Auth::user()->lname }}" placeholder="Last name" id="input2"
                                                type="text" >
                                                @error('lname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                @endif
                                        </div>
                                    </div>

                                    {{-- Company Name --}}
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-10" for="input3">Company Name
                                                <span class="checkout__input--label__star"></span></label>

                                                @if(Auth::user()->company_name == '')
                                                <input class="checkout__input--field border-radius-5"
                                                value="{{ old('company_name') }}" name="company_name"
                                                placeholder="Company (optional)" id="input6" type="text" >

                                                @else

                                            <input class="checkout__input--field border-radius-5"
                                                value="{{ Auth::user()->company_name }}" name="company_name"
                                                placeholder="Company (optional)" id="input3" type="text">

                                                @endif
                                        </div>
                                    </div>

                                    {{-- Address1 --}}
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-10" for="input4">Address <span
                                                    class="checkout__input--label__star">*</span></label>

                                                    @if(Auth::user()->address1 == '')
                                                    <input class="checkout__input--field border-radius-5"
                                                    value="{{ old('address1') }}" name="address1"
                                                    placeholder="Address1" id="input6" type="text" >
                                                    @error('address1')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    @else



                                            <input class="checkout__input--field border-radius-5"
                                                value="{{ Auth::user()->address1 }}" name="address1"
                                                placeholder="Address1" id="input4" type="text" >
                                                @error('address1')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                @endif
                                        </div>
                                    </div>

                                    {{-- Address2 --}}
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">


                                            @if(Auth::user()->address2 == '')
                                            <input class="checkout__input--field border-radius-5"
                                            value="{{ old('address2') }}" name="address2"
                                            placeholder="Apartment, suite, etc. (optional)" id="input6" type="text" >

                                            @else

                                            <input class="checkout__input--field border-radius-5"
                                                value="{{ Auth::user()->address2 }}" name="address2"
                                                placeholder="Apartment, suite, etc. (optional)" type="text" >

                                            @endif

                                        </div>
                                    </div>

                                    {{-- City --}}
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-10" for="input5">Town/City <span
                                                    class="checkout__input--label__star">*</span></label>

                                                    @if(Auth::user()->city == '')
                                                    <input class="checkout__input--field border-radius-5"
                                                    value="{{ old('city') }}" name="city"
                                                    placeholder="City" id="input6" type="text" >
                                                    @error('city')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    @else


                                            <input class="checkout__input--field border-radius-5"
                                                value="{{ Auth::user()->city }}" name="city" placeholder="City"
                                                id="input5" type="text" >
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                @endif
                                        </div>
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-10" for="input5">Phone <span
                                                    class="checkout__input--label__star">*</span></label>
                                                    @if(Auth::user()->phone == '')
                                                    <input class="checkout__input--field border-radius-5"
                                                    value="{{ old('phone') }}" name="phone"
                                                    placeholder="Phone" id="input6" type="text" >
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    @else
                                                <input class="checkout__input--field border-radius-5"
                                                    value="{{ Auth::user()->phone }}" name="phone"
                                                    placeholder="Phone" id="input6" type="text" required>
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    @endif




                                            {{-- <input class="checkout__input--field border-radius-5"
                                                value="{{ Auth::user()->phone }}" name="phone" placeholder="Phone"
                                                id="input5" type="text" >
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror --}}


                                        </div>
                                    </div>

                                    {{-- Country --}}
                                    <div class="col-lg-6 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-10" for="country">Country/region
                                                <span class="checkout__input--label__star">*</span></label>
                                            <div class="checkout__input--select select">
                                                <select name="country"
                                                    class="checkout__input--select__field border-radius-5"
                                                    id="country" >
                                                    <option value="1">India</option>
                                                    <option value="2">United States</option>
                                                    <option value="3">Netherlands</option>
                                                    <option value="4">Afghanistan</option>
                                                    <option value="5">Islands</option>
                                                    <option value="6">Albania</option>
                                                    <option value="7">Antigua Barbuda</option>
                                                </select>
                                                @error('country')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Pincode --}}
                                    <div class="col-lg-6 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-10" for="input6">Postal Code
                                                <span class="checkout__input--label__star">*</span></label>
                                                @if(Auth::user()->pincode == '')
                                                <input class="checkout__input--field border-radius-5"
                                                value="{{ old('pincode') }}" name="pincode"
                                                placeholder="Postal code" id="input6" type="text" >
                                                @error('pincode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @else
                                            <input class="checkout__input--field border-radius-5"
                                                value="{{ Auth::user()->pincode }}" name="pincode"
                                                placeholder="Postal code" id="input6" type="text" >
                                                @error('pincode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- S H I P    W I T H   T H E    D I F F E R E N T   A D D R E S S --}}
                            {{-- <details>
                                <summary class="checkout__checkbox mb-20">
                                    <input class="checkout__checkbox--input" type="checkbox">
                                    <span class="checkout__checkbox--checkmark"></span>
                                    <span class="checkout__checkbox--label">Ship to a different address?</span>
                                </summary>
                                <div class="section__shipping--address__content">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                            <div class="checkout__input--list ">
                                                <label class="checkout__input--label mb-10" for="input7">Fist Name <span class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" placeholder="First name (optional)" id="input7"  type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label mb-10" for="input8">Last Name <span class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" placeholder="Last name" id="input8"  type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label mb-10" for="input9">Company Name <span class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" placeholder="Company (optional)" id="input9" type="text">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label mb-10" for="input10">Address <span class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" placeholder="Address1" id="input10" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="checkout__input--list">
                                                <input class="checkout__input--field border-radius-5" placeholder="Apartment, suite, etc. (optional)"  type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label mb-10" for="input11">Town/City <span class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" placeholder="City" id="input11" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label mb-10" for="country2">Country/region <span class="checkout__input--label__star">*</span></label>
                                                <div class="checkout__input--select select">
                                                    <select class="checkout__input--select__field border-radius-5" id="country2" required>
                                                        <option value="1">India</option>
                                                        <option value="2">United States</option>
                                                        <option value="3">Netherlands</option>
                                                        <option value="4">Afghanistan</option>
                                                        <option value="5">Islands</option>
                                                        <option value="6">Albania</option>
                                                        <option value="7">Antigua Barbuda</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label mb-10" for="input12">Postal Code <span class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" placeholder="Postal code" id="input12" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </details> --}}


                              {{-- State --}}
                              <div class="col-lg-6 mb-20">
                                <div class="checkout__input--list">
                                    <label class="checkout__input--label mb-10" for="input2">State <span
                                            class="checkout__input--label__star">*</span></label>


                                            {{-- @if(isset(Auth::user()->state = ''))

                                                <input class="checkout__input--field border-radius-5" name="state"
                                                value="hello" placeholder="State" id="input2"
                                                type="text" >

                                            @endifvalue="{{ old('email') }}" --}}

                                            @if(Auth::user()->state == '')
                                            <input class="checkout__input--field border-radius-5" name="state"
                                            value="{{ old('state') }}" placeholder="State" id="input2"
                                            type="text" >
                                            @error('state')
                                                        <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            @else


                                            <input class="checkout__input--field border-radius-5" name="state"
                                                value="{{ Auth::user()->state }}" placeholder="State" id="input2"
                                                type="text" >
                                            @error('state')
                                                        <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            @endif
                                </div>
                            </div>

                            {{-- <div class="checkout__checkbox">
                                <input class="checkout__checkbox--input" id="checkbox2" type="checkbox">
                                <span class="checkout__checkbox--checkmark"></span>
                                <label class="checkout__checkbox--label" for="checkbox2">
                                    Save this information for next time</label>
                            </div> --}}
                        </div>
                        {{-- E N D   O F    B I L L I N G ----------------------------------------------------------- --}}

                        {{-- O R D E R   N O T E S---------------------------------------------------------------- --}}
                        {{-- <div class="order-notes mb-20">
                            <label class="checkout__input--label mb-10" for="order">Order Notes <span
                                    class="checkout__input--label__star"></span></label>
                            <textarea class="checkout__notes--textarea__field border-radius-5" id="order"
                                placeholder="Notes about your order, e.g. special notes for delivery." spellcheck="false"></textarea>
                        </div> --}}
                        {{-- ------------------------------------------------------------------------------------- --}}

                        {{-- C O N T I N U E   T O    S H O P P I N G    OR     R E T U R N  T O   C A R T ------- --}}
                        <div class="checkout__content--step__footer d-flex align-items-center">
                            <a class="continue__shipping--btn primary__btn border-radius-5" href="/shopping">Continue
                                To Shopping</a>
                            <a class="previous__link--content" href="{{ url('cart') }}">Return to cart</a>
                        </div>
                        {{-- ------------------------------------------------------------------------------------- --}}
                    </div>
                </div>





                {{-- O R D E R     S U M M A R Y ------------------------------------------------------------------------- --}}
                @if ($cartitems->count() > 0)
                    <div class="col-lg-5 col-md-6 couponprice">
                        <aside class="checkout__sidebar sidebar border-radius-10">
                            <h2 class="checkout__order--summary__title text-center mb-15">Your Order Summary</h2>
                            <div class="cart__table checkout__product--table ">

                                {{-- I F     P R O D U C T S   I N   C A R T --}}
                                @if ($cartitems->count() > 0)
                                    <table class="cart__table--inner">
                                        <tbody class="cart__table--body">
                                            @php $total = 0;  @endphp
                                            @php $subtotal = 0;  @endphp
                                            @php $shipping = 80; @endphp
                                            @foreach ($cartitems as $items)
                                                <tr class="cart__table--body__items">
                                                    <td class="cart__table--body__list">
                                                        <div class="product__image two  d-flex align-items-center cart_data">
                                                            <div class="cartdelete">
                                                                <input type="hidden" value="{{ $items->prod_id }}" class="prod_id">
                                                                <button class="cart__remove--btn delete-cart" aria-label="search button" type="button">
                                                                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="16px" height="16px"><path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/></svg>
                                                                </button>
                                                            </div>


                                                            {{-- <div class="cartdelete">
                                                                <button class="cart__remove--btn delete-cart-item" aria-label="search button" type="button">
                                                                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="16px" height="16px"><path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/></svg>
                                                                </button>
                                                                </div> --}}



                                                            <div class="product__thumbnail border-radius-5">
                                                                <a class="display-block"
                                                                    href="{{ url('category/'.$items->products->category->slug.'/'.$items->products->id) }}"><img
                                                                        class="display-block border-radius-5"
                                                                        src="{{ asset('assets/uploads/products/' . $items->products->image) }}"
                                                                        alt="cart-product"></a>
                                                                <span
                                                                    class="product__thumbnail--quantity">{{ $items->prod_qty }}
                                                                </span>
                                                            </div>
                                                            <div class="product__description">
                                                                <h4 class="product__description--name"><a
                                                                        >{{ $items->products->name }}</a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{-- <div id="new_price_update">
                                                        @php $total += $items->products->selling_price * $items->prod_qty @endphp
                                                    </div>
                                                    @php $subtotal += $items->products->selling_price * $items->prod_qty;   @endphp --}}

                                                    @php $subtotal += $items->products->selling_price * $items->prod_qty;   @endphp
                                                    @php $total += $items->products->selling_price * $items->prod_qty + $shipping;   @endphp
                                                    {{-- @php $total += $items->products->selling_price * $items->prod_qty + $shipping;   @endphp --}}
                                                    <td class="cart__table--body__list">
                                                        <span
                                                            class="cart__price">Rs.{{ $items->products->selling_price }}</span>
                                                    </td>
                                                </tr>






                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- I F    N O    P R O D U C T S    I N   C A R T --}}
                                @else
                                    <div class="card-body text-center">
                                        <h2>No products in cart</h2>
                                    </div>
                                @endif

                            </div>


                            {{-- <form name="shopping" id="sortProducts">
                                @csrf
                            <div class="product__view--mode__list product__short--by align-items-center d-flex">
                                <label class="product__view--label">Sort By :</label>
                                <div class="select shop__header--select">
                                    <select name="sort_by" id="sort_by" class="product__view--select select-box hello">
                                        <option selected value="">Select</option>
                                        <option value="product_latest">Sort by latest</option>
                                        <option value="Lowest_price">Sort by lowest price</option>
                                        <option value="highest_price">Sort by highest price</option>
                                        <option value="name_a_z">Sort by product name A-Z</option>
                                        <option value="name_z_a">Sort by product name Z-A</option>
                                    </select>

                                </div>

                            </div>
                          </form> --}}





                            {{-- P R O M O     C O D E --}}
                            <div class="checkout__discount--code">
                                {{-- <form class="d-flex" method="post" action="{{ url('coupon') }}"> --}}
                                    {{-- @csrf --}}
                                    <label>
                                        <input class="checkout__discount--code__input--field border-radius-5 coupon_code"
                                            placeholder="Gift card or discount code" type="text" name="coupon_code">
                                    </label>
                                    <button
                                        class="checkout__discount--code__btn primary__btn border-radius-5 apply_coupon_btn"
                                        type="submit">Apply</button>
                                    {{-- </form> --}}
                                </div>
                                <small id="error_coupon" class="text-danger"></small>

                                {{-- <h6 class="">
                                    {{ number_format($subtotal, 0) }}
                                </h6>
                                <h6 class="discount_price">0.00</h6>
                                <h6 class="grandtotal_price">{{ number_format($subtotal, 0) }}</h6> --}}

                                {{-- </form> --}}
                            {{-- </div> --}}




                            {{-- C H E C K O U T     T O T A L --}}
                            <div class="checkout__total">
                                <table class="checkout__total--table">
                                    <tbody class="checkout__total--body">

                                        {{-- S U B   T O T A L --}}
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left">Subtotal </td>
                                            <td class="checkout__total--amount text-right ">Rs.{{ number_format($subtotal, 0) }}</td>
                                        </tr>

                                        {{-- D I S C O U N T --}}
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left">Discount Price </td>
                                            <td class="checkout__total--amount text-right discount_price">Rs.00</td>
                                        </tr>

                                        {{-- S H I P P I N G    F E E --}}
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left">Shipping</td>
                                            {{-- <td class="checkout__total--calculated__text text-right">Calculated at next step</td> --}}
                                            <td class="checkout__total--calculated__text text-right">
                                                Rs.{{ $shipping }}</td>
                                        </tr>

                                    </tbody>




                                    {{-- T O T A L     P R I C E --}}
                                    <tfoot class="checkout__total--footer">
                                        <tr class="checkout__total--footer__items">
                                            <td
                                                class="checkout__total--footer__title checkout__total--footer__list text-left">
                                                Total </td>
                                            <td
                                                class="checkout__total--footer__amount checkout__total--footer__list text-right grandtotal_price">
                                                Rs.{{ $subtotal + $shipping }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            {{-- P A Y M E N T --}}
                            {{-- <div class="payment__history mb-30">
                                <h3 class="payment__history--title mb-20">Payment</h3>
                                <ul class="payment__history--inner d-flex">
                                    <li class="payment__history--list"><button
                                            class="payment__history--link primary__btn" type="submit">Credit
                                            Card</button></li>
                                    <li class="payment__history--list"><button
                                            class="payment__history--link primary__btn" type="submit">Bank
                                            Transfer</button></li>
                                    <li class="payment__history--list"><button
                                            class="payment__history--link primary__btn" type="submit">Paypal</button>
                                    </li>
                                </ul>
                            </div> --}}
                            <br>

                            {{-- C H E C K O U T   B U T T O N --}}
                            {{-- <a type="submit" class="checkout__now--btn primary__btn">Checkout Now</a> --}}
                            <button class="checkout__now--btn primary__btn" type="submit">Place Order</button>

                        </aside>
                    </div>
                    {{-- O R D E R    S U M M A R Y    E N D S---------------------------------------------------------------------- --}}

                    {{-- I F    N O    O R D E R S------------------------------------------------------------------------------ --}}
                @else
                    <div class="col-lg-5 col-md-6">
                        <aside class="checkout__sidebar sidebar border-radius-10">
                            <h2 class="checkout__order--summary__title text-center mb-15">Your Order Summary</h2>
                            <div class="cart__table checkout__product--table">

                            </div>

                            <div class="checkout__total">
                                <table class="checkout__total--table">
                                    <tbody class="checkout__total--body">
                                        <p>No Orders</p>
                                    </tbody>

                                </table>
                            </div>

                            <a href="/shopping" class="checkout__now--btn primary__btn" type="submit">Continue
                                Shopping</a>
                        </aside>
                    </div>
                @endif
                {{-- ------------------------------------------------------------------------------------------------------- --}}

            </div>

        </form>
    </div>
</div>

<script>
        $(document).ready(function(){
        $('.apply_coupon_btn').click(function(e){
            e.preventDefault();

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // alert('hi');


            var coupon_code = $('.coupon_code').val();





            if ($.trim(coupon_code).length == 0) {
                error_coupon = "Please enter valid Coupon";
                $('#error_coupon').text(error_coupon);
            } else {
                error_coupon = '';
                $('#error_coupon').text(error_coupon);
            }

            if (error_coupon != '') {
                return false;
            }

            $.ajax({
                method: "POST",
                url: "/check-coupon-code",
                data: {
                    'coupon_code' : coupon_code,
                },

                success: function (response) {
                    if(response.error_status == 'error')
                    {
                        alertify.set('notifier','position','top-right');
                        alertify.success(response.status);
                    }
                    else
                    {
                          // alert(response.status);
                            //   window.location.reload();
                            //   $('.couponprice').load(location.href + " .couponprice");
                            var discount_price = response.discount_price;
                            // alert(discount_price);
                            var grand_total_price = response.grand_total_price;
                            // alert(grand_total_price);
                            $('.coupon_code').prop('readonly',true);
                            $('.discount_price').text("Rs." +discount_price);
                            $('.grandtotal_price').text("Rs." +grand_total_price);



                    //         $('#attr_id').val(response.id);
                    // $('#product_price').html("Rs." + response.price)


                    }

                }


            });



                });
        });
</script>
