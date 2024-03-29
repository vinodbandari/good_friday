{if !empty($products)}
    {assign var='itempage' value=3}
    {assign var='count' value=0}
    <div class="block_content pt-10 pb-35">
        {$novproduct=array_chunk($products,$itempage)}
        {foreach from=$novproduct item=products name=mypLoop}
            {if $count < 3}
                <div class="products_block products_menu slick-dotted">
                    {foreach from=$products item=product name=products}
                        {$count = $count + 1}
                        <div class="item1">
                            <div class="product-miniature1 js-product-miniature   {if $smarty.foreach.products.first}first_item{elseif $smarty.foreach.products.last}last_item{/if}" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product" >
                                <div class="thumbnail-container">
                                    {block name='product_thumbnail'}
                                        <a href="{$product.url}" class="thumbnail product-thumbnail">
                                            <img
                                                class="img-fluid"
                                                src = "{$product.cover.bySize.home_default.url}"
                                                alt = "{$product.cover.legend}"
                                                data-full-size-image-url = "{$product.cover.large.url}"
                                                >
                                        </a>
                                    {/block}
                                </div>
                                <div class="product-description">
                                    {block name='product_name'}
                                        <div class="product-title" itemprop="name"><a href="{$product.url}">{$product.name|truncate:24:'...'}</a></div>
                                        {/block}
                                    <div class="product-groups">
                                        <div class="product-group-price">
                                            {block name='product_price_and_shipping'}
                                                {if $product.show_price}
                                                    <div class="product-price-and-shipping">
                                                        {hook h='displayProductPriceBlock' product=$product type="before_price"}
                                                        <span itemprop="price" class="price">{$product.price}</span>
                                                        {if $product.has_discount}
                                                            {hook h='displayProductPriceBlock' product=$product type="old_price"}
                                                            <span class="regular-price">{$product.regular_price}</span>
                                                        {/if}

                                                        {hook h='displayProductPriceBlock' product=$product type='unit_price'}

                                                        {hook h='displayProductPriceBlock' product=$product type='weight'}
                                                    </div>
                                                {/if}
                                            {/block}
                                        </div>
                                    </div>

                                </div>		    
                            </div>
                        </div>
                    {/foreach}
                </div>	
            {/if}
        {/foreach}
    </div>
{/if}