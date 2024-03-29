/**
* 2007-2020 PrestaShop
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2020 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/

document.addEventListener('DOMContentLoaded', function() {
	if (!('creativePageType' in window)) return;

	$('.btn[id$=_form_cancel_btn]').removeAttr('onclick').attr('href', location.href.replace(/&id\w*=\d+|&(add|update)[a-z]+(=1)?/g, ''));

	function onClickBtn(e) {
		if (~this.href.indexOf('&id=0') || ~this.href.indexOf('&id_page=0')) {
			e.preventDefault();
			return alert(creativePageSave);
		}
		if (!creativePageType) {
			var $type = $('#type');
			if ($type.val() != $type.next().val()) {
				e.preventDefault();
				return alert(creativePageSave);
			}

			this.href = this.href.replace('&type=', '$&' + $('#type').next().val());
		}
	}

	var btnTmpl = $('#tmpl-btn-edit-with-elementor').html();

	if (~creativePageHook.indexOf('Product')) {
		var $tf = $('<div class="translationsFields tab-content">').wrap('<div class="translations tabbable">');
		$tf.parent()
			.insertAfter('#related-product')
			.before('<h2 class="ce-product-hook">' + creativePageHook + '</h2>')
		;

		$('textarea[id*=description_short_]').each(function(i, el) {
			var id = el.id.split('_').pop(),
				lang = el.parentNode.className.match(/translation-label-(\w+)/),
				$btn = $(btnTmpl).click(onClickBtn),
				href = $btn.attr('href');

			$btn.attr('href', href.replace('&token=', '&id_lang=' + id + '$&').replace('&type=product', '&type=' + creativePageHook));
			$('<div class="translation-field tab-pane">')
				.addClass(lang ? 'translation-label-'+lang[1] : '')
				.addClass(el.parentNode.classList.contains('active') ? 'active' : '')
				.addClass(el.parentNode.classList.contains('visible') ? 'visible' : '')
				.append($btn)
				.appendTo($tf)
			;
		});
	}

	$([
		'textarea[name^=content_]',
		'textarea[name^=description_]:not([name*=short])',
		'textarea[name*="[content]"]',
		'textarea[name*="[description]"]'
	].join()).each(function(i, el) {
		var id = el[el.id ? 'id' : 'name'].split('_').pop(),
			$btn = $(btnTmpl).insertBefore(el).click(onClickBtn),
			href = $btn.attr('href');

		$btn.attr('href', href.replace('&token=', '&id_lang=' + id + '$&'));

		if (!creativePageType || $.inArray(id, hideEditor) >= 0) {
			$(el).hide().next('.maxLength').hide();
		} else {
			$btn.after('<br>');
		}
	});
});
