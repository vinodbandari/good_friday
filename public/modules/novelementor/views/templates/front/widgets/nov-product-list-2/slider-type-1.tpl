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
        <div class="block-product row">
            <div class="product-left col-xl-5 col-lg-5 col-md-12 d-flex align-items-center">
                {if isset($title) && !empty($title)}
                    <h2 class="title_block text-lg-left pb-60 pb-xs-40">
                        <span class="title_content mb-20">{$title}</span>
                        {if isset($sub_title) && !empty($sub_title)}
                            <span class="sub_title">{$sub_title}</span>
                        {/if}
                        {if isset($view_all) && !empty($view_all)}
                            <span class="show_all mt-20 d-block">
                                <a href="{$settings.link.url}">
                                    {$view_all}
                                </a>
                            </span>
                        {/if}
                    </h2>
                {/if}
            </div>
            <div class=" col-xl-7 col-lg-7 col-md-12 col-sm-12 col-xs-12">
                <div class="block_content style-1">
                    <div class="nov-produc swiper-container swiper-container1 swiper" data-rows="{$number_row}" data-lg="{$lg}" data-md="{$md}" data-xs="{$xs}" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">
                        <div class="swiper-wrapper">
                            {include file="$nov_dir./templates/_partials/layout/items/item_four.tpl" class_item='' showdeal=false margin_bottom =$spacing}
                        </div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
{/if}