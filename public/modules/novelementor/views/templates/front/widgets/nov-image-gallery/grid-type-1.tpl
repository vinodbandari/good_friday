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
    <div class="row no-flow grid-type spacing-0">
        {$k =0}
        {$count = count($images)}
        {foreach from=$images item=image}
            {if ($k == 0)}
                <div class="item image w-xl-40 w-lg-40 w-md-40 col-xl-5 mb-0">
                    <a class="thumbnail" href="{$image.url}" data-image-id="{$image.id}" data-toggle="modal" data-title="{$image.title}" data-image="{$image.src}" data-target="#image-gallery">
                        <img class="img_thumbnail" src="{$image.src}" class="img-fluid" />
                        <i class="instagram2" aria-hidden="true"></i>
                    </a>
                </div>
            {else}
                {if ($k == 1)} <div class="w-xl-60 w-lg-60 w-md-60 col-xl-7  pl-0 pr-0"> <div class="row spacing-0 w-lg-100"> {/if}
                        <div class="item image img-right col-4 col-lg-4 col-md-4 mb-0">
                            <a class="thumbnail" href="{$image.url}" data-image-id="{$image.id}" data-toggle="modal" data-title="{$image.title}" data-image="{$image.src}" data-target="#image-gallery">
                                <img class="img_thumbnail" src="{$image.src}" class="img-fluid" />
                                <i class="instagram2" aria-hidden="true"></i>
                            </a>
                        </div>
                        {if ($k == $count - 1)}               
                        </div>
                    </div>
                {/if}
            {/if}
            {$k =$k +1}
        {/foreach}
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
