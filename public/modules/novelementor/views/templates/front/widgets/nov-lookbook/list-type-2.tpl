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

{if isset($lookbooks) && !empty($lookbooks)}
    <div class="nov-lookbooklist2">
        <div class="block block-lookbooklist clearfix">
            {if isset($settings.title) && !empty($settings.title)}
                {if $settings.type_title == '1'}
                    <h2 class="title_block text-center mb-30">
                        <div class="title">{$settings.title}</div>
                        {if isset($settings.sub_title) && !empty($settings.sub_title)}
                            <div class="sub_title pt-15 pb-15">{$settings.sub_title}</div>
                        {/if}
                        {if !empty($settings.contenttext)}
                            <div class="desc_title">{$settings.contenttext}</div>
                        {/if}
                    </h2>
                {else}
                    <h2 class="title_block type_2 d-flex align-items-center justify-content-center">
                        <div>
                            {if isset($settings.sub_title) && !empty($settings.sub_title)}
                                <span class="sub_title">{$settings.sub_title}</span>
                            {/if}
                            <span class="title">{$settings.title}</span>
                            <div class="desc_title">{$settings.contenttext nofilter}</div>
                        </div>
                    </h2>
                {/if}
            {/if}

            <div class="block_content">
                <div class="row no-flow d-flex align-items-center">
                    {foreach from=$lookbooks item=lookbook name=lookbook}
                        <div class="nov-content-left col-xl-8 col-lg-8 col-md-8 mb-xs-30">
                            <img class="img-fluid img-responsive" src="{$nov_dir}modules/novlookbook/views/img/{$lookbook.image}" alt="lookbook" class="img-fluid"/>
                            {if $lookbook.hotsposts}
                                {foreach $lookbook.hotsposts item=hotspost name=hotspost key=k}
                                    <div class="item-lookbook d-xs-none" style="left:{$hotspost.left}%;top:{$hotspost.top}%">
                                        <span class="number-lookbook {if {$k}==0} active {/if}" data-position="{$k}"></span>
                                    </div>
                                    {$k =$k +1}
                                {/foreach}
                            {/if}
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 slide-wrapper">
                            <div class="slide-lookbook owl-carousel owl-theme">
                                {if $lookbook.hotsposts}
                                    {foreach $lookbook.hotsposts item=hotspost name=hotspost key=k}
                                        <div class="item" >
                                            {if $hotspost.sku}
                                                <div class="main-lookbook">
                                                    <div class="item-thumb">
                                                        <a href="{$hotspost.link}" alt="{$hotspost.link_rewrite}"><img src="{$hotspost.image}" alt="{$hotspost.link_rewrite}" class="img-fluid"/></a>
                                                    </div>
                                                    <div class="content-bottom pt-20">
                                                        <div class="item-title">
                                                            <a href="{$hotspost.link}" alt="{$hotspost.link_rewrite}">{$hotspost.name}</a>
                                                        </div>
                                                        <div class="item-price">
                                                            {$hotspost.price}
                                                        </div>
                                                    </div>
                                                </div>
                                            {else}
                                                <div class="content-lookbook with-link" style="{$hotspost.style}">
                                                    <a href="{$hotspost.href}" target="_blank">{$hotspost.text}</a>
                                                </div>
                                            {/if}
                                        </div>
                                    {/foreach}
                                {/if}

                            </div>
                            {if $lookbook.hotsposts}
                                <div class="nov-content-lookbook">
                                {foreach $lookbook.hotsposts item=hotspost name=hotspost key=k}
                                    <div class="item-lookbook">
                                        <span class="number-lookbook {if {$k}==0} active {/if}" data-position="{$k}">+</span>
                                    </div>
                                    {$k =$k +1}
                                {/foreach}
                                </div>
                            {/if}
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
{/if}