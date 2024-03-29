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

<div class="nov-banner-img-2 spacing-0">
    <div class="block_content style-1 row">
        <div class="content pl-15 pr-15 mb-xs-30">
            <div class="title text-center">{$settings.title}</div>
            <div class="description text-center d-block pt-23">{$settings.content}</div>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            {if (isset($settings.image.url) && $settings.image.url)}
                <div class="img_left">
                    {if isset($settings.button) && !empty($settings.button)}
                        <div class="text-center pl-22 pr-22">
                            <a class="hover_icon" href="{$settings.link_buttom.url}">
                                <span>{$settings.button}</span>
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </a>
                        </div>

                    {/if}
                    <img class="img_ins w-100 img-1 ls-is-cached" src="{$settings.image.url}" alt="{$settings.title}" />
                </div>
            {/if}
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            {if (isset($settings.image2.url) && $settings.image2.url)}
                <div class="img_right">
                    {if isset($settings.button2) && !empty($settings.button2)}
                        <div class="text-center pl-22 pr-22">
                            <a class="hover_icon" href="{$settings.link_buttom2.url}">
                                <span>{$settings.button2}</span>
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </a>
                        </div>
                    {/if}
                    <img class="img_ins w-100 img-2 ls-is-cached " src="{$settings.image2.url}" alt="{$settings.title}" />
                </div>
            {/if}
        </div>
    </div>
</div>


