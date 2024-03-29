<div class="single__widget widget__bg">
    <h2 class="widget__title h3">Top Rated Product</h2>
    @foreach($featured_products as $prods)
        <div class="shop__sidebar--product">
            <div class="small__product--card d-flex">
                <div class="small__product--thumbnail">
                    <a class="display-block" href="/category/{{ $prods->category->slug }}/{{ $prods->id }}"><img style="height: 50px;width:70px;" src="{{ asset('assets/uploads/products/'.$prods->image) }}" alt="product-img" ></a>
                </div>
                <div class="small__product--content">
                    <h3 class="small__product--card__title"><a href="/category/{{ $prods->category->slug }}/{{ $prods->id }}">{{ $prods->name }}</a></h3>
                    <div class="small__product--card__price mb_5">
                        <span class="current__price">Rs.{{ $prods->selling_price }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
