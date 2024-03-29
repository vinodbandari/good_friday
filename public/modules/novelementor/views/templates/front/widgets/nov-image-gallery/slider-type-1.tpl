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

<div class="nov_image_gallery {if !empty($el_class)}{$el_class}{/if}">
    {if isset($title) && !empty($title)}
        <div class="block_title">
            <div class="title">{$title}</div>
            {if isset($sub_title) && !empty($sub_title)}
                <span class="sub_title">{$sub_title}</span>
            {/if}
        </div>
    {/if}
     <div class="block_content">
    <div class="row no-flow slick-slider gallery spacing-{$spacing}"  data-lg="{$xl}" data-md="{$md}" data-xs="{$xs}" >
        {foreach from=$images item=image}
            <div class="item image">
                <a class="thumbnail" href="{$image.url}" data-image-id="{$image.id}" data-toggle="modal" data-title="{$image.title}" data-image="{$image.src}" data-target="#image-gallery">
                    <img class="img_thumbnail" src="{$image.src}" class="img-fluid" />
                    <i class="instagram2" aria-hidden="true"></i>
                </a>
            </div>
        {/foreach}
    </div>
     </div>
    <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="image-gallery-title"></h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="zmdi zmdi-close"></i></button>
                </div>
                <div class="modal-body pt-0">
                    <img id="image-gallery-image" class="img-fluid" src="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="zmdi zmdi-chevron-left"></i>
                    </button>

                    <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="zmdi zmdi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
