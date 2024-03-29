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

<div class="nov-youtube">
    <div class="block">
        <div class="block_content">
            <div class="content-video text-center">
                {if isset($settings.title_1) && !empty($settings.title_1)}<div class="title-video">{$settings.title_1}</div>{/if}
                 {if isset($settings.sub_title) && !empty($settings.sub_title)} <div class="title-sub">{$settings.sub_title}</div> {/if}
                 {if isset($settings.sub_title2) && !empty($settings.sub_title2)}<div class="title-sub2">{$settings.sub_title2}</div>{/if}
                 {if isset($settings.sub_title3) && !empty($settings.sub_title3)}<div class="title-sub3">{$settings.sub_title3}</div>{/if}
                 {if isset($settings.sub_title4) && !empty($settings.sub_title4)}<div class="title-sub4">{$settings.sub_title4}</div>{/if}
                {if isset($settings.button) && !empty($settings.button)}
                    <div class="youtube-bottom">
                    <a href="{$settings.link_buttom.url}" class="hover_icon btn-3">
                        <span>{$settings.button}</span>
                        <i class="zmdi zmdi-long-arrow-right"></i>
                    </a>
                    </div>
                {/if}
            </div>
            <video playsinline="" autoplay="" loop="" muted="" style="width: 100%;max-width: 100%; height: auto;">
                <source src="{$settings.link.url}" type="video/mp4">
            </video>
        </div>
    </div>
</div>
