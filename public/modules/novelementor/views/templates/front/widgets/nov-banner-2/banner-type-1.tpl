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
    <div class="row">
        <div class="col-xl-8 col-lg-7 col-md-12">
            <div class="banner-img">
           <img class="w-100" src="{$settings.image.url}" alt="{$settings.title}" />
            </div>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-12 mt-30 text-center d-flex align-items-center justify-content-center {$settings.display_type}">
            <div class="content-left text-left pb-md-20">
                <div class="title">{$settings.title}</div>
                <div class="description"><p>{$settings.content}<p></div>
                {if isset($settings.button) && !empty($settings.button)}
                    <a class="hover_icon mt-20" href="{$settings.link.url}"><span>{$settings.button}</span>
                    <i class="zmdi zmdi-long-arrow-right"></i></a>
                {/if}
            </div>
        </div>
    </div>
</div>