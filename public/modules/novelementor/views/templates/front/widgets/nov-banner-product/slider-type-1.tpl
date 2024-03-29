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

<div class="nov_banner-product">
    {if isset($title) && !empty($title)}
        <div class="text-left">
            <h2 class="title_block">
                <span class="title_content">{$title}</span>
                {if isset($sub_title) && !empty($sub_title)}
                    <span class="sub_title">{$sub_title}</span>
                {/if}
            </h2>
        </div>
    {/if}
    <div class="block_content">
        <div class="banner-content d-flex">
            <div class="banner-img banner-left w-50 grid slick-slider" data-xl="1" data-lg="1" data-md="1" data-xs="1" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">
                {foreach from=$images item=image}
                    <div class="item image">
                        <div class="img-hover position-relative">
                            <img class="w-100 img-icon img_thumbnail" src="{$image.src}" class="img-fluid" />
                        </div>
                    </div>
                {/foreach}
            </div>
            <div class="banner-img banner-right w-50 grid slick-slider">
                {foreach from=$images item=image}
                    <div class="item image">
                        <div class="img-hover position-relative">
                            <img class="w-100 img-icon img_thumbnail" src="{$image.src2}" class="img-fluid" />
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
        <div class="banner-text">
            <div class=" text-content grid slick-slider" data-xl="1" data-lg="1" data-md="1" data-xs="1" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">
                {foreach from=$images item=image}
                    <div class="item">
                        <div class="content mt-xs-30">
                            <div class="caption-animate title mb-17" >{$image.text}</div>
                            <div class="caption-animate title2 mb-22" >{$image.text2}</div>
                            <div class="description pt-3"><p>{$image.text3}</p></div>
                            {if isset($image.button) && !empty($image.button)}
                                <a class="hover_icon" href="{$image.url}">
                                    <span>{$image.button}</span>
                                    <i class="zmdi zmdi-long-arrow-right"></i>
                                </a>
                            {/if}
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    </div>
</div>
