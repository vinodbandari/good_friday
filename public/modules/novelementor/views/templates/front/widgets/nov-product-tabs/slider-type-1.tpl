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

<div class="nov-producttabs tab-slider tab-style-{$tabs_style}{if $show_arrows == 'true'} show_arrows{/if}{if isset($title) && !empty($title)} has_title{/if}{if isset($el_class) && !empty($el_class)}{$el_class}{/if}">
    <div class="block-producttabs clearfix">
        <div class="text-center mb-7 mb-xs-10 block_nav">
            {if isset($title) && !empty($title)}
                <h2 class="title_block mb-xs-20">
                    {$title}
                    {if isset($sub_title) && !empty($sub_title)}
                        <span class="sub_title">{$sub_title}</span>
                    {/if}
                </h2>
            {/if}
            <ul class="nav nav-tabs style-{$tabs_style}" role="tablist">
                {foreach from=$tabs item=tab_item name=tab}
                    {if $tab_item == 'newproducts'}
                        <li class="nav-item">
                            <a href="#newproducts{$tab}" class="nav-link active" role="tab" data-toggle="tab" aria-selected="true">{l s='New Arrivals' mod='novmanagevcaddons'}</a>
                        </li>
                    {/if}
                    {if $tab_item == 'bestsellers'}
                        <li class="nav-item">
                            <a href="#bestsellers{$tab}" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">{l s='Bestseller' mod='novmanagevcaddons'}
                            </a>
                        </li>
                    {/if}
                    {if $tab_item == 'specialproducts'}
                        <li class="nav-item">
                            <a href="#specialproducts{$tab}" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">{l s='On Sale' mod='novmanagevcaddons'}</a></li>
                        {/if}
                        {if $tab_item == 'featureproducts'}
                        <li class="nav-item">
                            <a href="#featureproducts{$tab}" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">{l s='Featured' mod='novmanagevcaddons'}</a></li>
                        {/if}
                    {/foreach}
            </ul>
        </div>
        <div class="block_content">
            <div class="tab-content">
                {foreach from=$tabs item=tab_item name=tabcontent}
                    {if $tab_item == 'newproducts'}
                        <div class="tab-pane fade active in" id="newproducts{$tab}" role="tabpanel">
                            {if !empty($newproducts)}
                                <div class="block-padding">
                                    <div class="nov-productslick  spacing-{$spacing} product_list grid" data-rows="{$number_row}" data-rows_mobile="{$number_row_mobile}" data-lg="{$lg}" data-md="{$md}" data-xs="{$xs}" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">
                                        {include file="$nov_dir./templates/_partials/layout/items/item_two.tpl" products=$newproducts class_item='col- pl-xs-5 pr-xs-5' margin_bottom =$spacing attributes=$groups1}
                                    </div>
                                </div>
                            {else}
                                <p class="alert alert-info">{l s='No products at this time.' mod='novmanagevcaddons'}</p>
                            {/if}
                        </div>
                    {/if}
                    {if $tab_item == 'bestsellers'}
                        <div class="tab-pane fade" id="bestsellers{$tab}" role="tabpanel">
                            {if !empty($bestsellersproducts)}
                                <div class="block-padding">
                                    <div class="nov-productslick  spacing-{$spacing} product_list grid" data-rows="{$number_row}" data-rows_mobile="{$number_row_mobile}" data-lg="{$lg}"  data-md="{$md}" data-xs="{$xs}" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">
                                        {include file="$nov_dir./templates/_partials/layout/items/item_two.tpl" products=$bestsellersproducts class_item='col- pl-xs-5 pr-xs-5' margin_bottom =$spacing attributes=$groups2}
                                    </div>
                                </div>
                            {else}
                                <p class="alert alert-info">{l s='No products at this time.' mod='novmanagevcaddons'}</p>
                            {/if}
                        </div>
                    {/if}
                    {if $tab_item == 'specialproducts'}
                        <div class="tab-pane fade" id="specialproducts{$tab}" role="tabpanel">
                            {if !empty($specialproducts)}
                                <div class="block-padding">
                                    <div class="nov-productslick  spacing-{$spacing} product_list grid" data-rows="{$number_row}" data-rows_mobile="{$number_row_mobile}" data-lg="{$lg}" data-md="{$md}" data-xs="{$xs}" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">
                                        {include file="$nov_dir./templates/_partials/layout/items/item_two.tpl" products=$specialproducts class_item='col- pl-xs-5 pr-xs-5' margin_bottom =$spacing attributes=$groups3}
                                    </div>
                                </div>
                            {else}
                                <p class="alert alert-info">{l s='No products at this time.' mod='novmanagevcaddons'}</p>
                            {/if}
                        </div>
                    {/if}
                    {if $tab_item == 'featureproducts'}
                        <div class="tab-pane fade" id="featureproducts{$tab}" role="tabpanel">
                            {if !empty($featureproducts)}
                                <div class="block-padding">
                                    <div class="nov-productslick  spacing-{$spacing} product_list grid" data-rows="{$number_row}" data-rows_mobile="{$number_row_mobile}" data-lg="{$lg}" data-md="{$md}" data-xs="{$xs}" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">
                                        {include file="$nov_dir./templates/_partials/layout/items/item_two.tpl" products=$featureproducts class_item='col- pl-xs-5 pr-xs-5' margin_bottom =$spacing attributes=$groups4}
                                    </div>
                                </div>
                            {else}
                                <p class="alert alert-info">{l s='No products at this time.' mod='novmanagevcaddons'}</p>
                            {/if}
                        </div>
                    {/if}
                {/foreach}
            </div>
        </div>
    </div>
</div>