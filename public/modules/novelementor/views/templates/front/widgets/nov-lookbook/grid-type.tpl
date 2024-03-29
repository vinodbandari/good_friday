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
    <div class="nov-lookbooklist">
        <div class="block block-lookbooklist clearfix">
            {if isset($settings.title) && !empty($settings.title)}
                <h2 class="title_block text-center mb-13">
                    <div class="title">{$settings.title}</div>
                </h2>
                {if !empty($settings.contenttext)}
                    <div class="desc_title text-center mb-50">{$settings.contenttext}</div>
                {/if}
            {/if}
            <div class="block_content spacing-20">
                <div class="row no-flow d-flex">
                    {$k =0}
                    {$count = count($lookbooks)}
                    {foreach from=$lookbooks item=lookbook name=lookbook}
                        <div class="nov-content-lookbook col-xl-3 col-lg-3 col-md-3 mb-20">
                            <div class="lookbook-product">
                                <img class="img-fluid img-responsive" src="{$nov_dir}modules/novlookbook/views/img/{$lookbook.image}" alt="lookbook" class="img-fluid"/>
                                <div class="shownow">
                                    <a class="hover-icon" href="#" data-toggle="modal" data-target="#image-lookbook{$k}">
                                        <span>{l s="Shop now" d='Shop.Theme.Layout'}</span>
                                        <i class="zmdi zmdi-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="modal fade" id="image-lookbook{$k}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content pl-10">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><i class="zmdi zmdi-close"></i></button>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="image col-md-7 col-sm-12 col-xs-12">
                                                <img class="img-fluid img-responsive" src="{$link->getMediaLink("`$smarty.const._MODULE_DIR_`novlookbook/views/img/`$lookbook.image|escape:'htmlall':'UTF-8'`")}" alt="lookbook"/>
                                                {if $lookbook.hotsposts}
                                                    {foreach $lookbook.hotsposts item=hotspost name=hotspost key=k}
                                                        <div class="item-lookbook" style="left:{$hotspost.left}%;top:{$hotspost.top}%">
                                                            <span class="number-lookbook"><span>+</span></span>
                                                            {if $hotspost.sku}
                                                                <div class="content-lookbook" style="{$hotspost.style}">
                                                                    <div class="item-thumb">
                                                                        <a href="{$hotspost.link}" alt="{$hotspost.link_rewrite}" ><img src="{$hotspost.image}" alt="{$hotspost.link_rewrite}"/></a>
                                                                    </div>
                                                                    <div class="lookbook-groups">
                                                                        <div class="item-title">
                                                                            <a href="{$hotspost.link}" alt="{$hotspost.link_rewrite}" >{$hotspost.name}</a>
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
                                            {if $lookbook.description}
                                                <div class="info-lookbook col-md-5 col-sm-12 col-xs-12">
                                                    <div class="pl-60 pr-60">
                                                        {if $lookbook.title}
                                                            <h2 class="title-lookbook">
                                                                {$lookbook.title}
                                                            </h2>
                                                        {/if}
                                                        {if $lookbook.description}
                                                            <div class="description-lookbook">
                                                                {$lookbook.description nofilter}
                                                            </div>
                                                        {/if}
                                                    </div>
                                                </div>
                                            {/if}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {$k =$k +1}
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
{/if}