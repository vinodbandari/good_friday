@if (isset($trending_products))
    <div class="pagination__area">
        {{ $trending_products->links('vendor.pagination.default') }}
    </div>
@elseif(isset($products))
    <div class="pagination__area">
        {{ $products->appends(request()->except('page'))->links('vendor.pagination.default') }}
    </div>
@endif
