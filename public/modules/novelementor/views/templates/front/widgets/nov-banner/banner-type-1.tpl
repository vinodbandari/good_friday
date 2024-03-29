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
        <a href="{$settings.link.url}"><img class="w-100" src="{$settings.image.url}" alt="{$settings.title}" /></a>
        <div class="content {$settings.display_type}">
            <div class="title">{$settings.title}</div>
            {if isset($settings.content) && !empty($settings.content)}
                <div class="description mb-6">{$settings.content}</div>
            {/if}
            {if isset($settings.button) && !empty($settings.button)}
                <a class="btn-2 pt-30" href="{$settings.link.url}">{$settings.button}</a>
            {/if}
        </div>
    </div>
</div>