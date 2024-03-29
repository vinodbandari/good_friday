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
    <div class="block style3 spacing-0">
        <div class="block_content row align-items-center">
            <div class="col-xl-bn-8 col-lg-7 col-md-12 col-sm-12 col-xs-12">
                <div class="wrapper-video">
                    <video playsinline="" autoplay="" loop="" muted="" style="width: 100%;max-width: 100%; height: auto;">
                        <source src="{$settings.link.url}" type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="col-xl-bn-4 col-lg-5 col-md-12 col-sm-12 col-xs-12">
                <div class="content-video pb-40">
                    {if isset($settings.title_1) && !empty($settings.title_1)}<div class="title-video">{$settings.title_1}</div>{/if}
                    {if isset($settings.content) && !empty($settings.content)}<div class="title-sub2 pt-20">{$settings.content}</div>{/if}
                    {if isset($settings.button) && !empty($settings.button)}
                        <div class="youtube-bottom mt-25">
                            <a href="{$settings.link_buttom.url}" class="hover_icon btn-3">
                                <span>{$settings.button}</span>
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </a>
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>
