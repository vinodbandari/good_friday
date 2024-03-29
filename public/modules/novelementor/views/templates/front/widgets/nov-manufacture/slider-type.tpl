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

{if isset($manus) && !empty($manus)}
    <div class="nov-manufacturelist ">
        <div class="block-manufacturelist clearfix">
            {if isset($settings.title) && !empty($settings.title)}
                <h2 class="title_block text-center pb-50">
                    <span class="title">{$settings.title}</span>
                    {if isset($settings.sub_title) && !empty($settings.sub_title)}
                        <span class="sub_title">{$settings.sub_title}</span>
                    {/if}
                </h2>
            {/if}
            <div class="block_content">
                <div class="nov-manufactureslick grid slick-slider spacing-{$settings.spacing}" data-rows="{$settings.number_row}" data-xl="{$settings.columns}" data-md="{$settings.columns_tablet}" data-xs="{$settings.columns_mobile}"  data-autoplay="{$autoplay}">
                    {foreach from=$manus item=manu}
                        <div class="item logo-manu text-center">
                            <a href="{$manu.url}" title="{$manu.name}">
                                <img class="img-fluid" src="{$manu.image|escape:'htmlall':'UTF-8'}" alt="logo-manu"/>
                            </a>
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
{/if}