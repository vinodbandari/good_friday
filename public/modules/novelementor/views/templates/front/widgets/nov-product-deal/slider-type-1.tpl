{if isset($products)}
    <div class="nov-productdeals{if isset($el_class) && $el_class} {$el_class}{/if}">
        <div class="block-product clearfix">
            {if isset($settings.title) && !empty($settings.title)}
                <h2 class="title_block text-center">
                    <span class="title_content">{$settings.title}</span>
                </h2>
            {/if}
            <div class="block_content">
                <div class="nov-productslick product_list grid slick-slider spacing-30" data-rows="{$settings.number_row}"  data-xl="{$settings.columns}" data-lg="{$settings.columns}" data-md="{$settings.columns_tablet}" data-xs="{$settings.columns_mobile}" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">
                    {include file="$nov_dir./templates/_partials/layout/items/item_three.tpl" class_item='pl-sm-10 pr-sm-10' showdeal=true margin_bottom =""}
                </div>
            </div>
        </div>
    </div>
{/if}