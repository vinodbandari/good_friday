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

<div class="nov_banner-slider">
    {if isset($title) && !empty($title)}
        <div class="text-left pb-70">
            <h2 class="title_block">
                <span class="title_content">{$title}</span>
                {if isset($sub_title) && !empty($sub_title)}
                    <span class="sub_title">{$sub_title}</span>
                {/if}
            </h2>
        </div>
    {/if}
    <div class="block_content">
        <div class="banner-slider-img swiper-container swiper spacing-{$spacing}" data-lg="{$lg}" data-md="{$md}" data-xs="{$xs}">
            <div class="swiper-wrapper">
                {foreach from=$images item=image}
                    <div class="swiper-slide">
                        <div class="item image">
                            <div class="img-hover">
                                <img class="w-100 img-icon img_thumbnail" src="{$image.src}" class="img-fluid" />
                            </div>
                            <div class="content pt-33">
                                <div class="title mb-10"><a href="{$image.url}">{$image.text}</a></div>
                                <div class="description mb-25">{$image.text2}</div>
                                {if isset($image.button) && !empty($image.button)}
                                    <a class="hover_icon btn-3" href="{$image.url}">
                                        <span>{$image.button}</span>
                                        <i class="zmdi zmdi-long-arrow-right"></i>
                                    </a>
                                {/if}
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
            <div class="swiper-button swiper-next"><i class="zmdi zmdi-chevron-right"></i></div>
            <div class="swiper-button swiper-prev"><i class="zmdi zmdi-chevron-left"></i></div>
        </div>
    </div>
</div>
