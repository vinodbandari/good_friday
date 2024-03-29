{if isset($slides)}
    <div class="slider-left d-flex align-items-center justify-content-center">
        <div class="block_social">
            <ul class="list-inline mb-0">
                {if isset($novconfig.social_facebook) && $novconfig.social_facebook}
                    <li class="list-inline-item"><a href="{$novconfig.social_facebook}"><i class="zmdi zmdi-facebook"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_twitter) && $novconfig.social_twitter}
                    <li class="list-inline-item"><a href="{$novconfig.social_twitter}"><i class="zmdi zmdi-twitter"></i></a></li>
                        {/if}

                {if isset($novconfig.social_instagram) && $novconfig.social_instagram}
                    <li class="list-inline-item"><a href="{$novconfig.social_instagram}"><i class="zmdi zmdi-instagram"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_dribbble) && $novconfig.social_dribbble}
                    <li class="list-inline-item"><a href="{$novconfig.social_dribbble}"><i class="zmdi zmdi-dribbble"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_flickr) && $novconfig.social_flickr}
                    <li class="list-inline-item"><a href="{$novconfig.social_flickr}"><i class="zmdi zmdi-flickr"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_pinterest) && $novconfig.social_pinterest}
                    <li class="list-inline-item"><a href="{$novconfig.social_pinterest}"><i class="zmdi zmdi-pinterest"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_linkedIn) && $novconfig.social_linkedIn}
                    <li class="list-inline-item"><a href="{$novconfig.social_linkedIn}"><i class="zmdi zmdi-linkedin"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_skype) && $novconfig.social_skype}
                    <li class="list-inline-item"><a href="{$novconfig.social_skype}"><i class="zmdi zmdi-skype"></i></a></li>
                        {/if}
            </ul>
        </div>
        <div class="slider-right">
            <div id="nov-slider" class="slider-wrapper theme-default col-xl-{$settings.columns nofilter} col-md-{$settings.columns nofilter}{if isset($class) && $class} {$class}{/if}"
                 data-effect="{$settings.effect nofilter}"
                 data-slices="{$settings.slices|intval}"
                 data-animSpeed="{$settings.animspeed|intval}"
                 data-pauseTime="{$settings.pausetime|intval}"
                 data-startSlide="{if isset($settings.startslide) && $settings.startslide}{$settings.startslide|intval}{else}1{/if}"
                 data-directionnav="{if isset($directionnav) && $directionnav == 1}true{else}false{/if}"
                 data-controlNav="{if isset($controlnav) && $controlnav == 1}true{else}false{/if}"
                 data-controlNavThumbs="{if isset($ctrnavthumbs) && $ctrnavthumbs}{$ctrnavthumbs nofilter}{else}false{/if}"
                 data-pauseOnHover="{if isset($pauseonhover) && $pauseonhover == 1}true{else}false{/if}"
                 data-manualAdvance="{if isset($manualadvance) && $manualadvance == 1}true{else}false{/if}"
                 data-randomStart="{if isset($randomstart) && $randomstart == 1}true{else}false{/if}">
                <div class="nov_preload">
                    <div class="process-loading active">
                        <div class="loader">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                </div>
                <div class="nivoSlider">
                    {foreach from=$slides item=slide name=slide}
                        <a href="{$slide.url|escape:'html':'UTF-8'}">
                            <img src="{$link->getMediaLink("`$smarty.const._MODULE_DIR_`novnivoslider/images/`$slide.image|escape:'htmlall':'UTF-8'`")}" alt="{$slide.title}" title="#htmlcaption_{$slide.id_slide}" />
                        </a>
                    {/foreach} 
                </div>
                {*        {foreach from=$slides item=slide name=slide}
                <div id="htmlcaption_{$slide.id_slide}" class="nivo-html-caption">
                <div class="nov-slider-ct">
                <div class="nov-center {$slide.align}">
                {if isset($slide.title) && trim($slide.title) != ''}
                <div class="nov-title {$slide.effect_title}" >
                {$slide.title nofilter}
                </div>
                {/if}
                {if isset($slide.description) && trim($slide.description) != ''}
                <div class="nov-description {$slide.effect_description}" >
                {$slide.description nofilter}
                </div>
                {/if}
                {if isset($slide.html) && trim($slide.html) != ''}
                <div class="nov-html {$slide.effect_html}">
                {$slide.html nofilter}
                </div>
                {/if}
                </div>
                </div>
                </div>
                {/foreach} *} 
            </div>
        </div>
    </div>
{/if}