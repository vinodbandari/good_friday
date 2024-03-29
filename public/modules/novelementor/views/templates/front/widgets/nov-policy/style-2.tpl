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

<div class="nov-policy">
    <div class="block_content style-2 d-flex align-items-center">
        <div class="policy-img"><img alt="{$settings.title}" src="{$settings.image.url}"  /></div>
        <div class="d-flex align-items-center">
            <div class="content">
                {if isset($settings.title) && !empty($settings.title)}
                    <div class="title_block">
                        {$settings.title}
                    </div>
                {/if}
                {if isset($settings.content) && !empty($settings.content)} 
                    <div class="mt-3">
                    {$settings.content nofilter}
                    </div>
                {/if}
            </div>
        </div>

    </div>
</div>