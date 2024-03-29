
<div class="products_block nov-productlist product-tabs pt-0 {if isset($class) && $class}{$class}{/if}">
    <div id="{$tab}" class="block-product clearfix">
        <div class=" title-tab row align-items-center mb-15 block_nav">
            <div class="w-tab col-xl-5 col-lg-5 col-md-8 col-sm-8 col-xs-12 pl-35">
                <ul class="nav nav-tabs list-tabs" role="tablist">
                    {if isset($categories) && $categories }
                        {foreach from=$categories item=category key=k name=categories}
                            <li class="nav-item">
                                <a class="nav-link{if $smarty.foreach.categories.first } active{/if}" href="#{$tab}category{$k}" role="tab" data-toggle="tab">
                                    <span class="title_category">
                                        {$category.name}
                                    </span>
                                </a>
                            </li>
                        {/foreach}
                    {/if}
                </ul>
            </div>
            {if isset($title) && !empty($title)}
                <div class="text-center col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12 order-md-1 mb-md-20">
                    <h2 class="title_block">
                        {$title nofilter}
                        {if isset($sub_title) && !empty($sub_title)}
                            <span class="sub_title">{$sub_title}</span>
                        {/if}
                    </h2>
                </div>
            {/if}
            <div class="col-xl-5 col-lg-5 col-md-4 col-sm-8 col-xs-12 text-md-right">
                {if isset($button) && !empty($button)}
                    <div class="mt-xs-30 mb-xs-15 pr-40 pr-xs-0">
                        <a class="bottom-icon" href="{$link_buttom.url}">{$button}</a>
                    </div>
                {/if}
            </div>
        </div>
        <div class="block_content">
            <div class="block-margin">
                <div class="block-padding">
                    <!-- Tab panes -->
                    <div class="product_tab_content tab-2 tab-content ">
                        {if isset($categories) && $categories }
                            {foreach from=$categories item=category key=k name=categories}
                                <div class="tab-pane fade {if $smarty.foreach.categories.first }in active{/if}" id="{$tab}category{$k}" role="tabpanel">
                                    {$products=$category.products} {$name_tab="{$tab}-category-{$k}"}
                                    {if !empty($products)}
                                        <div id="{$name_tab nofilter}" class="nov-productslick product_list grid spacing-{$spacing}" data-rows="{$number_row}" data-rows_mobile="{$number_row_mobile}" data-autoplayTimeout="6000" data-loop="true" data-margin="30" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}" data-lg="{$lg}"  data-md="{$md}" data-xs="{$xs}">
                                            {include file='_partials/layout/items/item_two.tpl' number_row=$number_row attributes=$category.groups}
                                        </div>
                                    {else}
                                        <p class="alert alert-info">{l s='No products at this time.' mod='novelementor'}</p>
                                    {/if}
                                </div>
                            {/foreach}
                        {/if}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
