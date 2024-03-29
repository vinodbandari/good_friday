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
    <div class="nov-productlist-2 {if isset($el_class) && $el_class} {$el_class}{/if}">
        <div class="block-product">
            {if isset($title) && !empty($title)}
                <h2 class="title_block text-lg-left pb-30">
                    <span class="title_content mb-20">{$title}</span>
                </h2>
            {/if}
            <div class="block_content style-2">
                <div class="nov-produc swiper-container2 swiper" data-rows="{$number_row}">
                    <div class="swiper-wrapper">
                        {include file="$nov_dir./templates/_partials/layout/items/item_four.tpl" class_item='' showdeal=false margin_bottom =$spacing}
                    </div>
                    <div class="swiper-scrollbar"></div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
{/if}