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
    <div class="nov-productlist nov-product_list slider-type-1{if isset($el_class) && $el_class} {$el_class}{/if}">
        <div class="block-product clearfix">
            {if isset($title) && !empty($title)}
                <div class="row style-title-1">
                    <h2 class="col-lg-12 col-md-12 title_block text-center">
                        <span class="title_content">{$title}{if isset($icon_title) && $icon_title == 1}<i class="pl-18 zmdi zmdi-favorite"></i>{/if}</span>
                        {if isset($sub_title) && !empty($sub_title)}
                            <span class="sub_title">{$sub_title}</span>
                        {/if}
                    </h2>  
                </div>
            {/if}
            <div class="block_content">
                <div class="nov-productslick product_list grid slick_slider slick-slider row spacing-{$spacing}" data-rows="{$number_row}" data-rows_mobile="{$number_row_mobile}" data-lg="{$lg}" data-md="{$md}" data-xs="{$xs}" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">
                    {include file="$nov_dir./templates/_partials/layout/items/item_one.tpl" class_item='col-' showdeal=false margin_bottom =$spacing}
                </div>
            </div>
        </div>
    </div>
{/if}