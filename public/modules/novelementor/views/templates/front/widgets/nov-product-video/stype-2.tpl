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
            <div class="col-md-5 mb-xs-50">
                <div class="content-video">
                    <video playsinline="" autoplay="" loop="" muted="" style="width: 100%;max-width: 100%; height: auto;" class="d-sm-block">
                        <source src="{$settings.link_youtobe.url}" type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="block_content col-md-7 mb-xs-20 d-flex align-items-center justify-content-center">
                {if isset($products)}
                    <div class="nov-product style-2" >
                        {if isset($title) && !empty($title)}
                            <div class=" style-title-1">
                                <h2 class="col-lg-12 col-md-12 title_block text-center mb-33">
                                    <span class="title_content">{$title}</span>
                                </h2>  
                            </div>
                        {/if}
                        {include file="$nov_dir./templates/_partials/layout/items/item_six.tpl" class_item='col-' showdeal=false}
                    </div>
                {/if}
            </div>
        </div>
    </div>
</div>
