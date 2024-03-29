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

<div class="nov-product-video">
    <div class="block-product clearfix spacing-0">
        <div class="row">
            <div class="col-md-6">
                <div class="content-video mb-xs-50">
                    <video playsinline="" autoplay="" loop="" muted="" style="width: 100%;max-width: 100%; height: auto;" class="d-sm-block">
                        <source src="{$settings.link_youtobe.url}" type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="block_content col-md-6 pb-xs-20 d-flex align-items-center justify-content-center">
                {if isset($products)}
                    <div class="nov-product style-1" >
                        {if isset($title) && !empty($title)}
                            <div class=" style-title-1">
                                <h2 class="col-lg-12 col-md-12 title_block text-center mb-33">
                                    <span class="title_content">{$title}</span>
                                </h2>  
                            </div>
                        {/if}
                        {include file="$nov_dir./templates/_partials/layout/items/item_two.tpl" class_item='col-' showdeal=false attributes=$groups}
                    </div>
                {/if}
            </div>
        </div>
    </div>
</div>
