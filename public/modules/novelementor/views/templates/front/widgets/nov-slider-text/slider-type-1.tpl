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

<div class="nov_banner-text">
    <div class="block_content">
        <div class="slider-text grid spacing-{$spacing}" data-lg="{$lg}" data-md="{$md}" data-xs="{$xs}" data-arrows="{$show_arrows}" data-autoplay="{$autoplay}">
            {foreach from=$images item=image}
                <div class="item image">
                    <div class="content text-center">
                        <div class="title">{$image.text}</div>
                    </div>
                </div>
            {/foreach}
        </div>
    </div>
</div>
