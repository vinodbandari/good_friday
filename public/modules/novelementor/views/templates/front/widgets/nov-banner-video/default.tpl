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

<div class="nov-banner-video">
    <div class="block">
        <div class="block_content">
            {if (isset($settings.image.url) && $settings.image.url)}
                <div class="bn-img img1">
                    <img class="w-100" src="{$settings.image.url}" alt="{$settings.title}" />
                </div>
            {/if}
            <div class="content-video text-center">
                {if isset($settings.title) && !empty($settings.title)}<div class="title-video">{$settings.title}</div>{/if}
                {if isset($settings.link_buttom.url) && !empty($settings.link_buttom.url)}
                    <div class="youtube-bottom">
                        <a href="{$settings.link_buttom.url}" class="hover_icon btn-3">
                            <span>{$settings.button}</span>
                            <i class="zmdi zmdi-long-arrow-right"></i>
                        </a>
                    </div>
                {/if}
            </div>
            <video playsinline="" autoplay="" loop="" muted="" style="width: 100%;max-width: 100%; height: auto; position: absolute; left: 0; top:0px;" >
                <source src="{$settings.link.url}" type="video/mp4">
            </video>
        </div>
    </div>
</div>
