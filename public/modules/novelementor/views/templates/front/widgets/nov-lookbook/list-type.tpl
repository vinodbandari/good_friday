{if isset($lookbooks)}
    <div class="nov-lookbook nov-lookbooklist {if isset($class) && $class} {$class}{/if}">
        {foreach from=$lookbooks item=lookbook name=lookbook}
            <div class="item">
                <div class="nov-content-lookbook">
                    <img class="img-fluid img-responsive" src="{$link->getMediaLink("`$smarty.const._MODULE_DIR_`novlookbook/views/img/`$lookbook.image|escape:'htmlall':'UTF-8'`")}" alt="lookbook"/>
                    {if $lookbook.hotsposts}
                        {foreach $lookbook.hotsposts item=hotspost name=hotspost key=k}
                            <div class="item-lookbook" style="left:{$hotspost.left}%;top:{$hotspost.top}%">
                                <span class="number-lookbook"><span>+</span></span>
                                {if $hotspost.sku}
                                    <div class="content-lookbook" style="{$hotspost.style}">
                                        <div class="item-thumb">
                                            <a href="{$hotspost.link}" alt="{$hotspost.link_rewrite}" ><img src="{$hotspost.image}" alt="{$hotspost.link_rewrite}"/></a>
                                        </div>
                                        <div class="lookbook-groups">
                                            <div class="item-title">
                                                <a href="{$hotspost.link}" alt="{$hotspost.link_rewrite}" >{$hotspost.name}</a>
                                            </div>
                                            <div class="item-price">
                                                {$hotspost.price}
                                            </div>
                                        </div>
                                    </div>
                                {else}
                                    <div class="content-lookbook with-link" style="{$hotspost.style}">
                                        <a href="{$hotspost.href}" target="_blank">{$hotspost.text}</a>
                                    </div>
                                {/if}
                            </div>
                        {/foreach}
                    {/if}
                </div>
            </div>
        {/foreach}
    </div>
{/if}
<!-- Module Lookbooks -->