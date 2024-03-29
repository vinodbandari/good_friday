<div class="shop__header d-flex align-items-center justify-content-between mb-30">
    <div class="product__view--mode d-flex align-items-center">
        <button class="widget__filter--btn d-flex d-lg-none align-items-center" data-offcanvas>
            <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"
                    d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80" />
                <circle cx="336" cy="128" r="28" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="28" />
                <circle cx="176" cy="256" r="28" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="28" />
                <circle cx="336" cy="384" r="28" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="28" />
            </svg>
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
            <div class="product__view--mode__list product__short--by align-items-center d-flex">
                <label class="product__view--label">Sort By :</label>
                <div class="col-3">
                    <a href="{{ URL::current() }}">All</a>
                </div>
                <br>
                <div class="col-3">

                    <a href="{{  request()->fullUrlWithQuery(['sort_by' => 'lowest_price'])  }}">Lowest</a><br>
                </div>

                <br>

                <div class="col-3">
                    <a href="{{  request()->fullUrlWithQuery(['sort_by' => 'highest_price'])  }}">Highest</a>
                </div>

                {{-- <br><br> --}}
                {{-- <div class="col-3">
                <a href="{{ url('shopping/'."?sort_by=highest_price") }}">Highest</a>
            </div> --}}



            </div>
        </form>



        {{-- T A B   A N D   R E C T A N G U L A R     V I E W --}}
        <div class="product__view--mode__list">
            <div class="product__tab--one product__grid--column__buttons d-flex justify-content-center">
                <button class="product__grid--column__buttons--icons active" aria-label="grid btn" data-toggle="tab"
                    data-target="#product_grid">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 9 9">
                        <g transform="translate(-1360 -479)">
                            <rect id="Rectangle_5725" data-name="Rectangle 5725" width="4" height="4"
                                transform="translate(1360 479)" fill="currentColor" />
                            <rect id="Rectangle_5727" data-name="Rectangle 5727" width="4" height="4"
                                transform="translate(1360 484)" fill="currentColor" />
                            <rect id="Rectangle_5726" data-name="Rectangle 5726" width="4" height="4"
                                transform="translate(1365 479)" fill="currentColor" />
                            <rect id="Rectangle_5728" data-name="Rectangle 5728" width="4" height="4"
                                transform="translate(1365 484)" fill="currentColor" />
                        </g>
                    </svg>
                </button>
                <button class="product__grid--column__buttons--icons" aria-label="list btn" data-toggle="tab"
                    data-target="#product_list">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 13 8">
                        <g id="Group_14700" data-name="Group 14700" transform="translate(-1376 -478)">
                            <g transform="translate(12 -2)">
                                <g id="Group_1326" data-name="Group 1326">
                                    <rect id="Rectangle_5729" data-name="Rectangle 5729" width="3" height="2"
                                        transform="translate(1364 483)" fill="currentColor" />
                                    <rect id="Rectangle_5730" data-name="Rectangle 5730" width="9" height="2"
                                        transform="translate(1368 483)" fill="currentColor" />
                                </g>
                                <g id="Group_1328" data-name="Group 1328" transform="translate(0 -3)">
                                    <rect id="Rectangle_5729-2" data-name="Rectangle 5729" width="3"
                                        height="2" transform="translate(1364 483)" fill="currentColor" />
                                    <rect id="Rectangle_5730-2" data-name="Rectangle 5730" width="9"
                                        height="2" transform="translate(1368 483)" fill="currentColor" />
                                </g>
                                <g id="Group_1327" data-name="Group 1327" transform="translate(0 -1)">
                                    <rect id="Rectangle_5731" data-name="Rectangle 5731" width="3"
                                        height="2" transform="translate(1364 487)" fill="currentColor" />
                                    <rect id="Rectangle_5732" data-name="Rectangle 5732" width="9"
                                        height="2" transform="translate(1368 487)" fill="currentColor" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
        </div>

    </div>
    {{-- <p class="product__showing--count">Showing 1–9 of 21 results</p> --}}
    {{-- <p class="product__showing--count">Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} results</p> --}}
</div>
