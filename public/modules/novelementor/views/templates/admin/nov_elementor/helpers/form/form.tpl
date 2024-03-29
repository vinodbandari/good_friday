{*
* 2007-2016 PrestaShop
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
*  @copyright  2007-2016 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{extends file="helpers/form/form.tpl"}

{block name="input_row"}
    {$smarty.block.parent}
    {if $input.name == 'type'}
        <script>
        var $type = $('#type').attr('type', 'hidden');
        var $hook = $('<select name="type">').html(
            '<option value="displayHome">displayHome</option>' +
            '<option value="displayHomeNovOne">displayHomeNovOne</option>' +
            '<option value="displayHomeNovTwo">displayHomeNovTwo</option>' +
            '<option value="displayHomeNovThree">displayHomeNovThree</option>' +
            '<option value="displayHomeNovFour">displayHomeNovFour</option>' +
            '<option value="displayHomeNovFive">displayHomeNovFive</option>' +
            '<option value="displayHomeNovSix">displayHomeNovSix</option>' +
            '<option value="displayHomeNovSeven">displayHomeNovSeven</option>' +
            '<option value="displayHomeNovEight">displayHomeNovEight</option>' +
            '<option value="displayHomeNovNine">displayHomeNovNine</option>' +
            '<option value="displayHomeNovTen">displayHomeNovTen</option>' +
            '<option value="displayHomeNovEleven">displayHomeNovEleven</option>' +
            '<option value="displayHomeNovTwelve">displayHomeNovTwelve</option>' +
            '<option value="displayTop">displayTop</option>' +
            '<option value="displayTopOne">displayTopOne</option>' +
            '<option value="displayTopTwo">displayTopTwo</option>' +
            '<option value="displayTopThree">displayTopThree</option>' +
            '<option value="displayTopFour">displayTopFour</option>' +
            '<option value="displayTopFive">displayTopFive</option>' +
            '<option value="displayTopSix">displayTopSix</option>' +
            '<option value="displayTopSeven">displayTopSeven</option>' +
            '<option value="displayTopEight">displayTopEight</option>' +
            '<option value="displayTopNine">displayTopNine</option>' +
            '<option value="displayTopTen">displayTopTen</option>' +
            '<option value="displayTopEleven">displayTopEleven</option>' +
            '<option value="displayLinkSearch">displayLinkSearch</option>' +
            '<option value="displayBanner">displayBanner</option>' +
            '<option value="displayNav1">displayNav1</option>' +
            '<option value="displayNav2">displayNav2</option>' +
            '<option value="displayNavFullWidth">displayNavFullWidth</option>' +
            '<option value="displayTopColumn">displayTopColumn</option>' +
            '<option value="displayLeftColumn">displayLeftColumn</option>' +
            '<option value="displayLeftColumnNov">displayLeftColumnNov</option>' +
            '<option value="displayRightColumn">displayRightColumn</option>' +
            '<option value="displayRightColumnNov">displayRightColumnNov</option>' +
            '<option value="displaySidebarBlogNov">displaySidebarBlogNov</option>' +
            '<option value="displayFooterBefore">displayFooterBefore</option>' +
            '<option value="displayFooter">displayFooter</option>' +
            '<option value="displayFooterNovOne">displayFooterNovOne</option>' +
            '<option value="displayFooterNovTwo">displayFooterNovTwo</option>' +
            '<option value="displayFooterNovThree">displayFooterNovThree</option>' +
            '<option value="displayFooterNovFour">displayFooterNovFour</option>' +
            '<option value="displayFooterNovFive">displayFooterNovFive</option>' +
            '<option value="displayFooterNovSix">displayFooterNovSix</option>' +
            '<option value="displayFooterNovSeven">displayFooterNovSeven</option>' +
            '<option value="displayFooterNovEight">displayFooterNovEight</option>' +
            '<option value="displayFooterNovNine">displayFooterNovNine</option>' +
            '<option value="displayFooterNovTen">displayFooterNovTen</option>' +
            '<option value="displayFooterAfter">displayFooterAfter</option>' +
            '<option value="displayAfterBodyOpeningTag">displayAfterBodyOpeningTag</option>' +
            '<option value="displayShoppingCart">displayShoppingCart</option>' +
            '<option value="displayShoppingCartFooter">displayShoppingCartFooter</option>' +
            '<option value="displayFooterProduct">displayFooterProduct</option>'
        ).insertAfter($type);

        if (!$hook.find('[value="'+$type.val()+'"]').length) {
            $('<option>', {
                value: $type.val(),
                html: $type.val()
            }).appendTo($hook);
        }

        $hook.val($type.val()).trigger('change');
        </script>
    {/if}
{/block}