<section class="shop__collection--section section--padding">
    <div class="container">
        <div class="section__heading text-center mb-40">
            <h2 class="section__heading--maintitle">Shop By Category</h2>
        </div>
        <div class="shop__collection--column5 swiper">
            <div class="swiper-wrapper">
                @foreach ($category as $cate)
                <div class="swiper-slide">
                    <div class="shop__collection--card text-center">
                        <a class="shop__collection--link" href="{{ url('category/'.$cate->slug) }}">
                            <img class="shop__collection--img" src="{{ asset('assets/uploads/category/'.$cate->image) }}" alt="icon-img" style="height: 180px;width:200px ;">
                            <h3 class="shop__collection--title mb-0">{{ $cate->name }}</h3>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper__nav--btn swiper-button-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
            <div class="swiper__nav--btn swiper-button-prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </div>
        </div>
    </div>
</section>
