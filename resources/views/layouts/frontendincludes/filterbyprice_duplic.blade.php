<div class="single__widget price__filter widget__bg">
    <h2 class="widget__title h3">Filter By Price</h2>
    <form class="price__filter--form" action="{{ url('filter') }}" method="get">
        @csrf
        <div class="price__filter--form__inner mb-15 d-flex align-items-center">
            <div class="price__filter--group">
                <label class="price__filter--label" for="Filter-Price-GTE1">From</label>
                <div class="price__filter--input border-radius-5 d-flex align-items-center">
                    <span class="price__filter--currency">$</span>
                    <input class="price__filter--input__field border-0" name="start_price" id="Filter-Price-GTE1" type="number" placeholder="0" min="0" >
                </div>
            </div>
            <div class="price__divider">
                <span>-</span>
            </div>
            <div class="price__filter--group">
                <label class="price__filter--label" for="Filter-Price-LTE1">To</label>
                <div class="price__filter--input border-radius-5 d-flex align-items-center">
                    <span class="price__filter--currency">$</span>
                    <input class="price__filter--input__field border-0" name="end_price" id="Filter-Price-LTE1" type="number" min="0" placeholder="250.00" >
                </div>
            </div>
        </div>
        <button class="" type="submit">Filter</button>
    </form>
</div>
