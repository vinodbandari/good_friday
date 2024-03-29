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

<div class="nov-banner-img-2">
    <div class="block_content style-2">
        <div class="content text-center pl-15 pr-15">
            <div class="title text-center">{$settings.title}</div>
            <div class="description text-center d-inline-block pt-25">{$settings.content}</div>
            <div class="d-flex align-items-center justify-content-center mt-55 mt-xs-15 mb-xs-10">
                {if isset($settings.button) && !empty($settings.button)}
                    <div class="text-center pl-10 pr-10">
                        <a class="hover_icon" href="{$settings.link_buttom.url}">
                            <span>{$settings.button}</span>
                            <i class="zmdi zmdi-long-arrow-right"></i>
                        </a>
                    </div>
                {/if}
                {if isset($settings.button2) && !empty($settings.button2)}
                    <div class="text-center pl-10 pr-10">
                        <a class="hover_icon" href="{$settings.link_buttom2.url}">
                            <span>{$settings.button2}</span>
                            <i class="zmdi zmdi-long-arrow-right"></i>
                        </a>
                    </div>
                {/if}
            </div>
        </div>
        {if (isset($settings.image.url) && $settings.image.url)}
            <div>
                <img class="img_ins w-100 img-1 ls-is-cached" src="{$settings.image.url}" alt="{$settings.title}" />
            </div>
        {/if}
    </div>
</div>


