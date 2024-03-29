{*
/******************
* Vinova Themes Framework for Prestashop 1.7.x 
* @package    novmanagevcaddons
* @version    1.0.0
* @author     http://vinovathemes.com/
* @copyright  Copyright (C) May 2019 vinovathemes.com <@emai:vinovathemes@gmail.com>
* <vinovathemes@gmail.com>.All rights reserved.
* @license    GNU General Public License version 1
* *****************/
*}

{if isset($products)}
    <div class="nov-productlist nov-product_list slider-type-3{if isset($el_class) && $el_class} {$el_class}{/if}">
        {if isset($title) && !empty($title)}
            <h2 class="title_block text-center {$style_title} mb-25">
                <span class="title_content">{$title}</span>
                {if isset($sub_title) && !empty($sub_title)}
                    <span class="sub_title">{$sub_title}</span>
                {/if}
            </h2>
        {/if}
        <div class="block_content">
            <div class="nov-productslick product_list grid slick_slider slick-slider row spacing-{$spacing}" data-rows="{$number_row}" data-rows_mobile="{$number_row_mobile}" data-lg="{$lg}" data-md="{$md}" data-xs="{$xs}" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">
                {include file="$nov_dir./templates/_partials/layout/items/item_two.tpl" class_item='col-' showdeal=false margin_bottom =$spacing attributes=$groups}
            </div>
        </div>
    </div>
</div>
{/if}