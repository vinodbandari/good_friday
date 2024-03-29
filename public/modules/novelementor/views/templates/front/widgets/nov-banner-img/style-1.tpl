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

<div class="nov-banner-img-product">
    <div class="block_content row">
        <div class="col-lg-5 col-md-12 d-lg-flex align-items-center justify-content-end">
            <div class="content">
                <div class="title mb-44">{$settings.title}</div>
                {if isset($settings.sub_title) && !empty($settings.sub_title)}
                    <span class="sub_title">{$settings.sub_title}</span>
                {/if}
                <div class="description d-block pt-15">{$settings.content}</div>
                {if isset($settings.button) && !empty($settings.button)}
                    <div class="d-inline-block mt-30">
                        <a class="hover_icon btn-3" href="{$settings.link.url}"><span>{$settings.button}</span>
                            <i class="zmdi zmdi-long-arrow-right"></i>
                        </a>
                    </div>
                {/if}
            </div>
        </div>
        <div class="col-lg-7 col-md-12 pt-100 pt-md-120">
            <div class="nov-image-centered">
                <div class="d-flex align-items-end justify-content-end">
                    {if (isset($settings.image.url) && $settings.image.url)}
                        <div>
                            <img class="img_ins img-1 ls-is-cached" src="{$settings.image.url}" alt="{$settings.title}" />
                        </div>
                    {/if}
                    {if (isset($settings.image2.url) && $settings.image2.url)}
                        <div>
                            <img class="img_ins img-2 ls-is-cached " src="{$settings.image2.url}" alt="{$settings.title}" />
                        </div>
                    {/if}
                    {if (isset($settings.image3.url) && $settings.image3.url)}
                        <div>
                            <img class="img_ins img-3 ls-is-cached" src="{$settings.image3.url}" alt="{$settings.title}" />
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>


