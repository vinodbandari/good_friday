{*/******************
* Vinova Themes  Framework for Prestashop 1.7.x 
* @package    novtestimonials
* @version    1.0
* @author    http://vinovathemes.com/
* @copyright  Copyright (C) May 2017 vinovathemes.com <@emai:vinovathemes@gmail.com>
* <info@vinovathemes.com>.All rights reserved.
* @license   GNU General Public License version 1
* *****************/
*}
{if isset($novtestimonials) && !empty($novtestimonials)}
    {if isset($config_testimonials.novtestimonials_type) && $config_testimonials.novtestimonials_type == 'type_one'}
        <div class="wow fadeInUp animated">
            <div id="testimonial_block" class="owl-carousel owl-theme testimonial-type-one" data-autoplay="false" data-autoplaytimeout="7000" data-loop="true" data-margin="30" data-dots="true" data-nav="true" data-items="{$config_testimonials.novtestimonials_item_desktop}" data-items_large ="{$config_testimonials.novtestimonials_item_large}" data-items_tablet="{$config_testimonials.novtestimonials_item_tablet}" data-items_mobile="{$config_testimonials.novtestimonials_item_mobile}">
                {foreach from=$novtestimonials item=testimonials name=testimonial}
                    <div class="item type-one">
                        <div class="content-info">
                            {if isset($testimonials.image) && $testimonials.image neq "" }
                                <div class="testimonial-avarta">
                                    <img class="img-fluid" src="{$config_testimonials.link_image}{$testimonials.image}" alt="">
                                </div>
                            {/if}
                            <div class="media-body">
                                {if $testimonials.name }
                                    <h5 class="mt-0 box-info">{$testimonials.name}</h5>
                                {/if}
                                {if $testimonials.address }
                                    <span class="box-dress">{$testimonials.address}</span>
                                {/if}
                            </div>
                            <div class="text">{if $novconfig.novthemeconfig_home_style && $novconfig.novthemeconfig_home_style == 'displayHomeNovTwo'} {$testimonials.content|strip_tags|truncate:200 nofilter} {else} {$testimonials.content nofilter}{/if}</div>
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    {elseif isset($config_testimonials.novtestimonials_type) && $config_testimonials.novtestimonials_type == 'type_two'}
        <div class="wow fadeInUp animated">
            <div id="testimonial_block" class="owl-carousel owl-theme testimonial-type-two" data-autoplay="false" data-autoplaytimeout="7000" data-loop="true" data-margin="30" data-dots="false" data-nav="true" data-items="{$config_testimonials.novtestimonials_item_desktop}" data-items_large ="{$config_testimonials.novtestimonials_item_large}" data-items_tablet="{$config_testimonials.novtestimonials_item_tablet}" data-items_mobile="{$config_testimonials.novtestimonials_item_mobile}">
                {foreach from=$novtestimonials item=testimonials name=testimonial}
                    <div class="item type-two">
                        <div class="content-info row d-flex align-items-center">
                            <div class="col-lg-7 col-md-12">
                                <div class="text">{if $novconfig.novthemeconfig_home_style && $novconfig.novthemeconfig_home_style == 'displayHomeNovTwo'} {$testimonials.content|strip_tags|truncate:200 nofilter} {else} {$testimonials.content nofilter}{/if}</div>
                                <div class="media-body">
                                    {if $testimonials.name }
                                        <h5 class="mt-0 box-info">{$testimonials.name}</h5>
                                    {/if}
                                    {if $testimonials.address }
                                        <span class="box-dress">{$testimonials.address}</span>
                                    {/if}
                                </div>
                            </div>
                            {if isset($testimonials.image) && $testimonials.image neq "" }
                                <div class="col-lg-5 col-md-12">
                                    <div class="testimonial-avarta">
                                        <img class="img-fluid" src="{$config_testimonials.link_image}{$testimonials.image}" alt="">
                                    </div>
                                </div>
                            {/if}
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    {/if}
{/if}
