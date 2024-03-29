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

<div class="nov-instagram">
    <div class="block_content row">
        <div class="col-md-6">
            <div class="content">
                <div class="title">{$settings.title}</div>
                {if isset($settings.sub_title) && !empty($settings.sub_title)}
                    <span class="sub_title">{$settings.sub_title}</span>
                {/if}
                <div class="description d-block pt-40">{$settings.content}<strong>{$settings.sub_title}</strong></div>
                {if isset($settings.adress) && !empty($settings.adress)}
                   <span class="sub_title2 pt-33 d-block">{$settings.adress}</span>
                {/if}
            </div>
        </div>
        <div class="col-lg-6 col-md-6 mt-xs-50">
            <div class="block_content nov-image-centered">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="img-left">
                        <div class="d-inline-flex img-left-top mb-10">
                            {if (isset($settings.image.url) && $settings.image.url)}
                                <div class="bn-img img1">
                                    <img class="w-100" src="{$settings.image.url}" alt="{$settings.title}" />
                                </div>
                            {/if}
                            {if (isset($settings.image2.url) && $settings.image2.url)}
                                <div class="bn-img img2">
                                    <img class="w-100" src="{$settings.image2.url}" alt="{$settings.title}" />
                                </div>
                            {/if}
                        </div>
                        <div class="d-flex img-left-bottom">
                            {if (isset($settings.image3.url) && $settings.image3.url)}
                                <div class="bn-img img3">
                                    <img class="w-100" src="{$settings.image3.url}" alt="{$settings.title}" />
                                </div>

                            {/if}
                            {if (isset($settings.image4.url) && $settings.image4.url)}
                                <div class="bn-img img4">
                                    <img class="w-100" src="{$settings.image4.url}" alt="{$settings.title}" />
                                </div>
                            {/if}
                        </div>
                    </div>
                    <div class="img-right">
                        {if (isset($settings.image5.url) && $settings.image5.url)}
                            <div class="mb-10">
                                <div class="bn-img img5">
                                    <img class="w-100" src="{$settings.image5.url}" alt="{$settings.title}" />
                                </div>
                            </div>
                        {/if}
                        {if (isset($settings.image6.url) && $settings.image6.url)}
                            <div>
                                <div class="bn-img img6">
                                    <img class="w-100" src="{$settings.image6.url}" alt="{$settings.title}" />
                                </div>
                            </div>
                        {/if}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


