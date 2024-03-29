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

<div class="nov-banner-img">
    <div class="block_content">
        {if isset($settings.display_content) && ($settings.display_content =="content-top")}
            <div class="content text-center mb-25 {$settings.display_type}">
                <div class="title">{$settings.title}</div>
                <div class="description">{$settings.content}</div>
                {if isset($settings.button) && !empty($settings.button)}
                    <a class="btn-2" href="{$settings.link.url}">{$settings.button}</a>
                {/if}
            </div> 
            <a href="{$settings.link.url}"><img class="w-100" src="{$settings.image.url}" alt="{$settings.title}" /></a>
            {else}
            <a href="{$settings.link.url}"><img class="w-100" src="{$settings.image.url}" alt="{$settings.title}" /></a>
            <div class="content text-center mt-25 {$settings.display_type}">
                <div class="title">{$settings.title}</div>
                <div class="description">{$settings.content}</div>
                {if isset($settings.button) && !empty($settings.button)}
                    <a class="btn-2" href="{$settings.link.url}">{$settings.button}</a>
                {/if}
            </div>
        {/if}
    </div>
</div>