<div class="single__widget widget__bg">
    <h2 class="widget__title h3">Categories</h2>
    @foreach ($categories as $category)
    <ul class="widget__categories--menu">
        {{-- <li class="widget__categories--menu__list">
            <label class="widget__categories--menu__label d-flex align-items-center">
                <img class="widget__categories--menu__img" src="{{ asset('assets/uploads/category/'.$category->image) }}" alt="categories-img">
                <span class="widget__categories--menu__text">{{ $category->name }}</span>
                <svg class="widget__categories--menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                    <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                </svg>
            </label>
            <ul class="widget__categories--sub__menu"> --}}
                <li class="widget__categories--sub__menu--list">
                    <a class="widget__categories--sub__menu--link d-flex align-items-center" href="/category/{{ $category->slug }}">
                        <img class="widget__categories--sub__menu--img" src="{{ asset('assets/uploads/category/'.$category->image) }}" alt="categories-img">
                        <span class="widget__categories--sub__menu--text">{{ $category->name }}</span>
                    </a>
                {{-- </li>
            </ul>
        </li> --}}
    </ul>
    @endforeach
</div>
