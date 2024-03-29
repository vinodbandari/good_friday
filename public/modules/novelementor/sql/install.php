<?php
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
*/
$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'novelementor` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_employee` int(11) NOT NULL,
    `active` tinyint(3) NOT NULL,
    `id_page` int(11) NOT NULL,
    `type` varchar(100) NOT NULL,
    `date_add` datetime NOT NULL,
    `date_upd` datetime NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'novelementor_lang` (
    `id` int(11) unsigned NOT NULL,
    `id_lang` int(11) unsigned NOT NULL,
    `id_shop` int(11) unsigned NOT NULL DEFAULT \'1\',
    `title` varchar(255) NOT NULL DEFAULT \'\',
    `data` longtext,
    PRIMARY KEY (`id`,`id_lang`,`id_shop`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'novelementor_meta` (
    `id` int(10) unsigned NOT NULL,
    `id_lang` int(10) unsigned NOT NULL,
    `id_shop` int(10) unsigned NOT NULL DEFAULT \'1\',
    `meta_key` varchar(255) NOT NULL,
    `meta_value` longtext NOT NULL,
    `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `date_upd` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\',
    PRIMARY KEY (`id`,`id_lang`,`id_shop`,`meta_key`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'novelementor_shop` (
    `id` int(10) unsigned NOT NULL,
    `id_shop` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`,`id_shop`),
    KEY `id_shop` (`id_shop`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
