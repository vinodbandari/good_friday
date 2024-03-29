
@if ($paginator->hasPages())
<div class="pagination__area">
    <nav class="pagination justify-content-center">
        <ul class="pagination__wrapper d-flex align-items-center justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="pagination__list">
                <a class="pagination__item--arrow  link ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292"></path></svg>
                    <span class="visually-hidden">page left arrow</span>
                </a>
            </li><li>
            </li>
            @else
                <li class="pagination__list">
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination__item--arrow  link " rel="prev" aria-label="@lang('pagination.previous')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292"></path></svg>
                    <span class="visually-hidden">page left arrow</span></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination__list"><span class="pagination__item pagination__item--current">{{ $page }}</span></li>
                        @else
                            <li class="pagination__list"><a href="{{ $url }}" class="pagination__item link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination__list">
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination__item--arrow  link " rel="next" aria-label="@lang('pagination.next')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100"></path></svg>
                        <span class="visually-hidden">page right arrow</span></a>
                </li>
            @else
            <li class="pagination__list">
                <a class="pagination__item--arrow  link ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100"></path></svg>
                    <span class="visually-hidden">page right arrow</span>
                </a>
            </li><li>
        </li>
            @endif
        </ul>
    </nav>
</div>
@endif


{{-- <div class="pagination__area">
    <nav class="pagination justify-content-center">
        <ul class="pagination__wrapper d-flex align-items-center justify-content-center">
            <li class="pagination__list">
                <a href="shop.html" class="pagination__item--arrow  link ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292"></path></svg>
                    <span class="visually-hidden">page left arrow</span>
                </a>
            </li><li>
            </li><li class="pagination__list"><span class="pagination__item pagination__item--current">1</span></li>
            <li class="pagination__list"><a href="shop.html" class="pagination__item link">2</a></li>
            <li class="pagination__list"><a href="shop.html" class="pagination__item link">3</a></li>
            <li class="pagination__list"><a href="shop.html" class="pagination__item link">4</a></li>
            <li class="pagination__list">
                <a href="shop.html" class="pagination__item--arrow  link ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100"></path></svg>
                    <span class="visually-hidden">page right arrow</span>
                </a>
            </li><li>
        </li></ul>
    </nav>
</div> --}}
