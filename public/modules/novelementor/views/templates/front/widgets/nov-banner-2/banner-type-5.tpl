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

<div class="nov-banner-img2 spacing-0">
    <div class="row text-center d-flex align-items-center justify-content-center">
        <div class="col-md-6 text-center mt-xs-20 {$settings.display_type} mb-xs-40">
            <div class="content-left text-right">
                <div class="title mb-24">{$settings.title}</div>
                <div class="description"><p>{$settings.content}</p></div>
                {if isset($settings.button) && !empty($settings.button)}
                    <a class="view-more mt-40" href="{$settings.link.url}">
                        <span>{$settings.button}</span>
                    </a>
                {/if}
            </div>
        </div>
        <div class="col-md-6 style4">
            <div class="banner-img">
           <img class="w-100" src="{$settings.image.url}" alt="{$settings.title}" />
            </div>
        </div>
    </div>
</div>