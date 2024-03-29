{*
/******************

* Vinova Themes  Framework for Prestashop 1.7.x 
* @package   	novblockwishlist
* @version   	1.0
* @author   	http://vinovathemes.com/
* @copyright 	Copyright (C) October 2013 vinovathemes.com <@emai:vinovathemes@gmail.com>
* <info@vinovathemes.com>.All rights reserved.
* @license   GNU General Public License version 1

* *****************/
*}
{if isset($novconfig.novthemeconfig_product_layoutv) && ($novconfig.novthemeconfig_product_layoutv == 'thumb-v1' || $novconfig.novthemeconfig_product_layoutv == 'thumb-v2' || $novconfig.novthemeconfig_product_layoutv == 'thumb-v6') }
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#collapseReviews">{l s='Customer reviews' d='Shop.Theme.Catalog'}<span class='count-comment'></span></a>
    </li>
{else}  
    <div class="btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        {l s='Customer reviews' d='Shop.Theme.Catalog'}
    </div>
{/if}