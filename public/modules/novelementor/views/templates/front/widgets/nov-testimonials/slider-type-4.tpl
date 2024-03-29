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

{if isset($testimonials) && !empty($testimonials)}
    <div class="nov-testimonial type_4{if isset($el_class) && $el_class}{$el_class}{/if}">
        {if isset($title) && !empty($title)}
            <h2 class="title_block text-{$title_align}">
                <span class="title_content">{$title}</span>
                {if isset($sub_title) && !empty($sub_title)}
                    <span class="sub_title">{$sub_title}</span>
                {/if}
            </h2>
        {/if}
        <div class="testimonial clearfix">
            <div class="block_content mb-60">
                <div class="nov-testimonialslick " data-rows="{$number_row}" data-lg="{$xl}" data-md="{$md}" data-xs="{$xs}" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">        
                    {foreach from=$testimonials item=testimonial}
                        <div class="item item-testimonial slider-type-one text-center">
                            <div class="text-center">
                                <div class="media-body">
                                    {if $testimonial.content }
                                        <div class="text-content mt-0 mb-5 mb-md-0">{$testimonial.content|truncate:300 nofilter}</div>
                                    {/if}
                                    <div class="bl_info d-inline-block">
                                        <div class="testimonial_author text-left d-flex">
                                            {if $testimonial.name }
                                                <h5 class="box-info mb-0 pt-2">{$testimonial.name}</h5>
                                            {/if}
                                            {if $testimonial.address }
                                                <span class="box-dress"> / {$testimonial.address}</span>
                                            {/if}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
{/if}