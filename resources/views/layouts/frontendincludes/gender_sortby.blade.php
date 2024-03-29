<div class="shop__header d-flex align-items-center justify-content-between mb-30">
    <div class="product__view--mode d-flex align-items-center">
        <button class="widget__filter--btn d-flex d-lg-none align-items-center" data-offcanvas>
            <svg  class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80"/><circle cx="336" cy="128" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/><circle cx="176" cy="256" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/><circle cx="336" cy="384" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/></svg>
            <span class="widget__filter--btn__text">Filter</span>
        </button>

        {{-- S E A R C H   B Y  P A G I N A T I O N    P A G E  N U M B E R --}}
        {{-- <div class="product__view--mode__list product__short--by align-items-center d-flex ">
            <label class="product__view--label">Prev Page :</label>
            <div class="select shop__header--select">
                <select class="product__view--select">
                    <option selected value="1">65</option>
                    <option value="2">40</option>
                    <option value="3">42</option>
                    <option value="4">57 </option>
                    <option value="5">60 </option>
                </select>
            </div>
        </div> --}}

        {{-- S O R T    B Y --}}

        <form name="shopping" id="sortProducts">
            @csrf
            {{-- <input type="hidden" class="cate_id" value="{{ $products->cate_id }}"> --}}
        <div class="product__view--mode__list product__short--by align-items-center d-flex">
            <label class="product__view--label">Sort By :</label>

            <div class="col-3">
                <a href="{{URL::current()}}">All</a>

            </div>


                <div class="col-3">
                    <a href="{{  request()->fullUrlWithQuery(['gend_by' => 'male'])  }}">Male</a>

                </div>

                <div class="col-3">
                    <a href="{{  request()->fullUrlWithQuery(['gend_by' => 'female'])  }}">Female</a>
                </div>

                <div class="col-3">
                    <a href="{{  request()->fullUrlWithQuery(['sort_by' => 'lowest_price'])  }}">Lowest</a>

                </div>

                <div class="col-3">
                    <a href="{{  request()->fullUrlWithQuery(['sort_by' => 'highest_price'])  }}">Highest</a>
                </div>



        </div>
      </form>





    </div>
    {{-- <p class="product__showing--count">Showing 1–9 of 21 results</p> --}}
    {{-- <p class="product__showing--count">Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} results</p> --}}
</div>



