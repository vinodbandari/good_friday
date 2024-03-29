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
    <div class="nov-product-trending type-slider-1{if isset($el_class) && $el_class} {$el_class}{/if}">
        <div class="block-product clearfix">
            <div class="block_content spacing-0">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="nov-product-trending-img">
                            {if count($products) == 1}
                                {if (isset($settings.image1.url) && $settings.image1.url)}
                                    <div class="item">
                                        <div class="product-miniature">
                                            <img class="img_ins img-2 ls-is-cached " src="{$settings.image1.url}" alt="{$settings.title}" />
                                        </div>
                                    </div>
                                {/if} 
                            {else if count($products) == 2}
                                {if (isset($settings.image1.url) && $settings.image1.url)}
                                    <div class="item">
                                        <div class="product-miniature">
                                            <img class="img_ins img-2 ls-is-cached " src="{$settings.image1.url}" alt="{$settings.title}" />
                                        </div>
                                    </div>
                                {/if}  
                                {if (isset($settings.image2.url) && $settings.image2.url)}
                                    <div class="item">
                                        <div class="product-miniature">
                                            <img class="img_ins img-2 ls-is-cached " src="{$settings.image2.url}" alt="{$settings.title}" />
                                        </div>
                                    </div>
                                {/if} 
                            {else if count($products) == 3}
                                {if (isset($settings.image1.url) && $settings.image1.url)}
                                    <div class="item">
                                        <div class="product-miniature">
                                            <img class="img_ins img-2 ls-is-cached " src="{$settings.image1.url}" alt="{$settings.title}" />
                                        </div>
                                    </div>
                                {/if}  
                                {if (isset($settings.image2.url) && $settings.image2.url)}
                                    <div class="item">
                                        <div class="product-miniature">
                                            <img class="img_ins img-2 ls-is-cached " src="{$settings.image2.url}" alt="{$settings.title}" />
                                        </div>
                                    </div>
                                {/if} 
                                {if (isset($settings.image3.url) && $settings.image3.url)}
                                    <div class="item">
                                        <div class="product-miniature">
                                            <img class="img_ins img-2 ls-is-cached " src="{$settings.image3.url}" alt="{$settings.title}" />
                                        </div>
                                    </div>
                                {/if}  
                            {/if}
                        </div>
                    </div>
                    <div class="product-content mt-md-30 mb-md-20">
                        {if isset($title) && !empty($title)}
                            <div class="num_nav">
                                <div class="current_nav"></div>
                            </div>
                        {/if}
                        {if isset($title) && !empty($title)}
                            <h2 class="title_block text-center">
                                <span class="title_content">{$title}</span>
                            </h2>
                        {/if}
                        <div class="slick-slider-dots2"></div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-xs-30 d-flex align-items-center justify-content-center">
                        <div class="product-right">
                            <div class="nov-productslick product_list grid slick-slider" data-rows="1"  data-xl="1" data-lg="1" data-md="1" data-xs="1" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">
                                {include file="$nov_dir./templates/_partials/layout/items/item_four.tpl" class_item='pl-sm-10 pr-sm-10' showdeal=true margin_bottom =''}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/if}
