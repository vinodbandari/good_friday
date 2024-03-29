<div class="single__widget price__filter widget__bg">
    <h2 class="widget__title h3">Filter By Price</h2>
    <h5><a href="{{ URL::current() }}">All</a> </h5>

    <h5><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'lowest_price']) }}">Lowest</a></h5>
    <h5><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'highest_price']) }}">Highest</a></h5> <br>
    <form class="price__filter--form" action="/shopping" method="GET">
        <div class="price__filter--form__inner mb-15 d-flex align-items-center">
            <div class="price__filter--group">
                <label class="price__filter--label" for="Filter-Price-GTE2">From</label>
                <div class="price__filter--input border-radius-5 d-flex align-items-center">
                    <span class="price__filter--currency">Rs.</span>
                    <input class="price__filter--input__field border-0" name="start_price" id="Filter-Price-GTE2"
                        type="number" placeholder="0" min="100" max="100000">
                </div>
            </div>
            <div class="price__divider">
                <span>-</span>
            </div>
            <div class="price__filter--group">
                <label class="price__filter--label" for="Filter-Price-LTE2">To</label>
                <div class="price__filter--input border-radius-5 d-flex align-items-center">
                    <span class="price__filter--currency">Rs.</span>
                    <input class="price__filter--input__field border-0" name="end_price" id="Filter-Price-LTE2"
                        type="number" min="0" placeholder="250.00" max="100000">
                </div>
            </div>
        </div>
        <button class="primary__btn price__filter--btn" type="submit">Filter</button>
    </form>
</div>
