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

<div class="nov-banner-img spacing-0">
    <div class="block_content">
        <div class="content {$settings.display_type}">
            <div class="banner-img mb-30">
                <img class="w-100" src="{$settings.image.url}" alt="{$settings.title}" />
                {if isset($settings.button) && !empty($settings.button)}
                    <a class="hover_icon" href="{$settings.link.url}">
                        <span>{$settings.button}</span>
                        <i class="zmdi zmdi-long-arrow-right"></i>
                    </a>
                {/if}
            </div>
            <div class="title mb-20">{$settings.title}</div>
            <div class="description">{$settings.content}</div>
        </div>
    </div>
</div>