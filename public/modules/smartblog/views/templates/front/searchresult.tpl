{*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{extends file='page.tpl'}
{block name='breadcrumb'}
    {if isset($breadcrumb)}
        <div class="breadcrumb" style=" {if isset($novconfig.novpopup_breadcrumb) && $novconfig.novpopup_breadcrumb == 1} background: url({$img_dir_themeconfig}{$novconfig.novpopup_breadcrumb_bg}); {/if} ">
            <div class="breadcrumb-title">{l s='Search results for' d='Modules.Smartblog'} <strong>{$smartsearch}</strong></div>
            <ol>
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="{$urls.base_url}">
                        <span itemprop="name">{l s='Home' d='Modules.Smartblog'}</span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="{smartblog::GetSmartBlogLink('smartblog')}">
                        <span itemprop="name">{l s='Our blog' d='Modules.Smartblog'}</span>
                    </a>
                    <meta itemprop="position" content="2">
                </li>
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <span itemprop="name">{l s='Search results for' d='Modules.Smartblog'} <strong>{$smartsearch}</strong></span>
                    <meta itemprop="position" content="3">
                </li>
            </ol>
        </div>
    {/if}
{/block}
{block name='page_content'}
    {if isset($novconfig.novthemeconfig_cateblog_type) && $novconfig.novthemeconfig_cateblog_type == 'grid'}
        {$column='col-sm-6'}
    {else}
        {$column='col-sm-12'}
    {/if}
    {if $postcategory == ''}
        {include file="module:smartblog/views/templates/front/search-not-found.tpl" postcategory=$postcategory}
    {else}
        <div id="smartblogcat" class="block">
            {if isset($novconfig.novthemeconfig_cateblog_type) && $novconfig.novthemeconfig_cateblog_type == 'grid'}
                <div class="center_column col-xs-12 col-sm-12 text-center" id="center_column">
                    <div class="pagenotfound">
                        <h2>({$total}){l s='results for' mod='smartblog'} <strong>"{$smartsearch}"</strong></h2>
                        <form class="std mt-30 mb-50 blog-search" method="post" action="{smartblog::GetSmartBlogLink('smartblog_search')|escape:'htmlall':'UTF-8'}">
                            <fieldset>
                                <div>
                                    <input type="text" class="form-control grey" value="{$smartsearch|escape:'htmlall':'UTF-8'}" name="smartsearch" id="search_query">
                                    <button class="btn btn-default button button-small" value="{l s='Ok' mod='smartblog'}" name="smartblogsubmit" type="submit"><span>{l s='Search' mod='smartblog'}</span></button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            {/if}
            <div class="row">
                {foreach from=$postcategory item=post}
                    {include file="module:smartblog/views/templates/front/category_loop.tpl" postcategory=$postcategory}
                {/foreach}
            </div>
        </div>
    {/if}
    {if isset($smartcustomcss)}
        <style>
            {$smartcustomcss|escape:'htmlall':'UTF-8'}
        </style>
    {/if}
{/block}