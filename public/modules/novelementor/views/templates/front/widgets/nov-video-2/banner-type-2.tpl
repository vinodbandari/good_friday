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

<div class="nov-youtube-2">
    <div class="block style2 mb-70">
        <div class="block_content text-center">
            <div class="content-video pb-40">
                {if isset($settings.title_1) && !empty($settings.title_1)}<div class="title-video">{$settings.title_1}</div>{/if}
                {if isset($settings.sub_title) && !empty($settings.sub_title)} <div class="title-sub">{$settings.sub_title}</div> {/if}
                {if isset($settings.content) && !empty($settings.content)}<div class="title-sub2 pt-20 mb-25">{$settings.content}</div>{/if}
                {if isset($settings.button) && !empty($settings.button)}
                    <div class="youtube-bottom">
                        <a href="{$settings.link_buttom.url}" class="hover_icon2 btn-3">
                            <span>{$settings.button}</span>
                            <i class="zmdi zmdi-long-arrow-right"></i>
                        </a>
                    </div>
                {/if}
            </div>
            <div class="wrapper-video">
                <video playsinline="" autoplay="" loop="" muted="" style="width: 100%;max-width: 100%; height: auto;">
                    <source src="{$settings.link.url}" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>
