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
        <h2 class="title_block text-center mb-30">
            <span class="title_content">{$title}</span>
            {if isset($sub_title) && !empty($sub_title)}
                <span class="sub_title">{$sub_title}</span>
            {/if}
        </h2>
    {/if}
    <div class="block_content">
        <div class="banner-slider style-2 grid owl-carousel owl-theme spacing-{$spacing}" data-autoplay="false" data-autoplayTimeout="6000" data-loop="true" data-margin="30" data-arrows="true" data-dots="false" data-autoplay="false" data-half="0" data-lg="{$lg}"  data-md="{$md}" data-xs="{$xs}">
            {foreach from=$images item=image}
                <div class="item image">
                    <div class="img-hover">
                        <img class="w-100 img-icon img_thumbnail" src="{$image.src}" class="img-fluid" />
                        {if isset($image.button) && !empty($image.button)}
                            <a href="{$image.url}">{$image.button}</a>
                        {/if}
                    </div>
                    <div class="content">
                        <div class="title">{$image.text}</div>
                        <div class="description">
                            <p>{$image.text2}</p>
                            {if isset($image.url) && !empty($image.url)}
                                <a class="btn_link" href="{$image.url}"><i class="zmdi zmdi-long-arrow-right"></i></a>
                            {/if}
                        </div>
                    </div>
                </div>
            {/foreach}
        </div>
    </div>
</div>
