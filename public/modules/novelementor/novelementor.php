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
if (!defined('_PS_VERSION_')) {
    exit;
}

require_once _PS_MODULE_DIR_ . '/novelementor/src/NovElementorPage.php';
require_once _PS_MODULE_DIR_ . '/novelementor/includes/plugin.php';

use NovElementor\Helper;
use PrestaShop\PrestaShop\Adapter\Presenter\Object\ObjectPresenter;
use PrestaShop\PrestaShop\Core\Product\ProductExtraContentFinder;

class NovElementor extends Module {

    const VIEWS = 'modules/novelementor/views/';

    protected $config_form = false;

    public function __construct($name = null, Context $context = null) {
        $this->name = 'novelementor';
        $this->tab = 'content_management';
        $this->version = '1.0.0';
        $this->author = 'VinovaThemes';
        $this->secure_key = Tools::encrypt($this->name);
        // $this->need_instance = 1;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;
        $this->controllers = array('preview');
        parent::__construct();

        $this->displayName = $this->l('Vinova Themes Elementor');
        $this->description = $this->l('Vinova Themes Elementor - Page builder based on PrestaShop Elementor');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall this module?');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);

        $this->dir = $this->context->language->is_rtl ? '-rtl' : '';
        $this->min = _PS_MODE_DEV_ ? '' : '.min';

        Shop::addTableAssociation(NovElementorPage::$definition['table'], array('type' => 'shop'));
        Shop::addTableAssociation(NovElementorPage::$definition['table'] . '_lang', array('type' => 'fk_shop'));
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install() {
        Configuration::updateValue('NOVELEMENTOR_LIVE_MODE', false);

        include(dirname(__FILE__) . '/sql/install.php');

        return parent::install() && $this->installTab() &&
                $this->registerHook('header') &&
                $this->registerHook('backOfficeHeader') &&
                $this->registerHook('actionAdminMetaControllerUpdate_optionsAfter') &&
                $this->registerHook('actionObjectCategoryAddAfter') &&
                $this->registerHook('actionObjectCategoryDeleteAfter') &&
                $this->registerHook('actionObjectCategoryUpdateAfter') &&
                $this->registerHook('actionObjectCmsDeleteAfter') &&
                $this->registerHook('actionObjectCmsUpdateAfter') &&
                $this->registerHook('actionObjectManufacturerAddAfter') &&
                $this->registerHook('actionObjectManufacturerDeleteAfter') &&
                $this->registerHook('actionObjectManufacturerUpdateAfter') &&
                $this->registerHook('actionObjectProductAddAfter') &&
                $this->registerHook('actionObjectProductDeleteAfter') &&
                $this->registerHook('actionObjectProductUpdateAfter') &&
                $this->registerHook('displayBackOfficeHeader') &&
                $this->registerHook('displayFooterProduct') &&
                $this->registerHook('displayHeader') &&
                $this->registerHook('displayHome');
    }

    public function uninstall() {
        Configuration::deleteByName('NOVELEMENTOR_LIVE_MODE');

        include(dirname(__FILE__) . '/sql/uninstall.php');

        return parent::uninstall() && $this->uninstallTab();
    }

    private function installTab() {
        $tabId = (int) Tab::getIdFromClassName('AdminParentThemes');
        if (!$tabId) {
            $tabId = null;
        }

        $tab = new Tab($tabId);
        $tab->active = 1;
        $tab->class_name = 'AdminNovElementor';
        $tab->name = array();
        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = "Nov Elementor - Page builder";
        }
        $tab->id_parent = (int) Tab::getIdFromClassName('AdminParentThemes');
        $tab->module = $this->name;

        $tab->add();

        return true;
    }

    private function uninstallTab() {
        $id_tab = (int) Tab::getIdFromClassName('AdminNovElementor');
        $tab = new Tab($id_tab);
        $tab->delete();

        return true;
    }

    public function getWidgetVariables($hookName = null, array $config = array()) {
        $id = (int) Tools::getValue('id');
        $id_lang = $this->context->language->id;
        $id_shop = $this->context->shop->id;
        $pages = array();
        $vars = array();

        if ($id && self::checkAdminToken() && !strcasecmp(Tools::getValue('cp_type'), $hookName)) {
            $pages[] = new NovElementorPage($id, $id_lang, $id_shop);
        } else {
            if (!strcasecmp('displayFooterProduct', $hookName)) {
                $id = $this->context->controller->getProduct()->id;
                $pages += NovElementorPage::getDataRows($hookName, !self::hasAdminToken('AdminProducts'), $id, $id_lang, $id_shop, 1);
            }
            $id = empty($config['id']) ? 0 : $config['id'];
            $pages += NovElementorPage::getDataRows($hookName, !self::hasAdminToken('AdminNovElementor'), $id, $id_lang, $id_shop);
        }

        foreach ($pages as &$page) {
            $obj = (object) $page;
            if (!empty($obj->id)) {
                $css_file = new NovElementor\PostCssFile($obj->id, $this->context->language->id);
                $css_file->enqueue();

                $vars[] = array(
                    'nov_elements' => NovElementor\Plugin::instance(),
                    'page_id' => $obj->id,
                    'page_data' => (array) json_decode($obj->data, true),
                );
            }
        }
        return $vars;
    }

    public static function checkAdminToken() {
        static $res = null;

        if (null === $res && Tools::getIsset('cp_type')) {
            $type = Tools::getValue('cp_type');
            $tab = $type == 'cms' ? 'AdminCmsContent' : ($type == 'product' || $type == 'displayFooterProduct' ? 'AdminProducts' : 'AdminNovElementor');
            $res = self::hasAdminToken($tab);
        }

        return $res;
    }

    public static function hasAdminToken($tab) {
        $adtoken = Tools::getAdminToken($tab . (int) Tab::getIdFromClassName($tab) . (int) Tools::getValue('id_employee'));
        return Tools::getValue('adtoken') == $adtoken;
    }

    /**
     * Load the configuration form
     */
    public function getContent() {
        Tools::redirectAdmin($this->context->link->getAdminLink('AdminNovElementor'));
    }

    /**
     * Add the CSS & JavaScript files you want to be loaded in the BO.
     */
    public function hookBackOfficeHeader() {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path . 'views/js/back.js');
            $this->context->controller->addCSS($this->_path . 'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader() {
        $this->context->controller->addJS($this->_path . '/views/js/front.js');
        $this->context->controller->addCSS($this->_path . '/views/css/front.css');
    }

    public function hookActionAdminMetaControllerUpdate_optionsAfter() {
        /* Place your code here. */
    }

    public function hookActionObjectCategoryAddAfter() {
        /* Place your code here. */
    }

    public function hookActionObjectCategoryDeleteAfter() {
        /* Place your code here. */
    }

    public function hookActionObjectCategoryUpdateAfter() {
        /* Place your code here. */
    }

    public function hookActionObjectCmsDeleteAfter() {
        /* Place your code here. */
    }

    public function hookActionObjectCmsUpdateAfter() {
        /* Place your code here. */
    }

    public function hookActionObjectManufacturerAddAfter() {
        /* Place your code here. */
    }

    public function hookActionObjectManufacturerDeleteAfter() {
        /* Place your code here. */
    }

    public function hookActionObjectManufacturerUpdateAfter() {
        /* Place your code here. */
    }

    public function hookActionObjectProductAddAfter() {
        /* Place your code here. */
    }

    public function hookActionObjectProductDeleteAfter() {
        /* Place your code here. */
    }

    public function hookActionObjectProductUpdateAfter() {
        /* Place your code here. */
    }

    public function hookDisplayBackOfficeHeader() {
        /* Place your code here. */
        $controller = Tools::getValue('controller');
        $hook = '';
        $hideEditor = array();
        preg_match('~/([^/]+)/(\d+)/edit\b~', $_SERVER['REQUEST_URI'], $req);
        switch ($controller) {
            case 'AdminNovElementor':
                $type = '';
                $id = (int) Tools::getValue('id');
                break;
            case 'AdminCmsContent':
                if ($req && $req[1] == 'category' || Tools::getIsset('addcms_category') || Tools::getIsset('updatecms_category')) {
                    break;
                }
                $type = 'cms';
                $id = (int) Tools::getValue('id_cms', $req ? $req[2] : 0);
                $hideEditor = NovElementorPage::getLangIdsByPage($type, $id);
                break;
            case 'AdminCategories':
                $type = 'category';
                $id = (int) Tools::getValue('id_category', $req ? $req[2] : 0);
                $hideEditor = NovElementorPage::getLangIdsByPage($type, $id);
                break;
            case 'AdminProducts':
                $hook = 'displayFooterProduct';
                $type = 'product';
                $id = (int) Tools::getValue('id_product', basename(explode('?', $_SERVER['REQUEST_URI'])[0]));
                $hideEditor = NovElementorPage::getLangIdsByPage($type, $id);
                break;
            case 'AdminBlogPost':
                $type = 'smartblog';
                $id = (int) Tools::getValue('id_smart_blog_post', basename(explode('?', $_SERVER['REQUEST_URI'])[0]));
                $hideEditor = NovElementorPage::getLangIdsByPage($type, $id);
                break;
        }

        if (isset($id)) {
            $id_key = empty($type) ? 'id' : 'id_page';
            $this->context->controller->addJQuery();
            $this->context->controller->js_files[] = $this->_path . 'views/js/back.js';
            $this->context->controller->css_files[$this->_path . 'views/css/back.css'] = 'all';

            Media::addJsDef(array(
                'hideEditor' => $hideEditor,
                'creativePageType' => $type,
                'creativePageHook' => $hook,
                'creativePageSave' => $this->l('Please save the form before editing with Elementor'),
            ));

            $this->context->smarty->assign(array(
                'edit_width_elementor' => $this->context->link->getAdminLink('NovElementorEditor') . "&type=$type&$id_key=$id",
            ));
        }

        return $this->context->smarty->fetch(_PS_MODULE_DIR_ . 'novelementor/views/templates/hook/backoffice_header.tpl');
    }

    public function hookDisplayFooterProduct($params) {
        /* Place your code here. */
        return $this->renderWidget('displayFooterProduct', $params);
    }

    public function hookDisplayHeader() {
        /* Place your code here. */
        $plugin = NovElementor\Plugin::instance();

        if (self::checkAdminToken() && Tools::getValue('render') == 'widget') {
            $plugin->editor->setEditMode(true);
            $plugin->widgets_manager->ajaxRenderWidget();
        }

        $this->context->smarty->registerClass('NovElementorUtils', '\NovElementor\Utils');

        //if (version_compare(_PS_VERSION_, '1.7', '<')) {
        $this->hookOverrideLayoutTemplate(null);
        //}

        Media::addJsDef(array(
            'elementorFrontendConfig' => array(
                'isEditMode' => '',
                'stretchedSectionContainer' => NovElementor\get_option('elementor_stretched_section_container', ''),
                'is_rtl' => !empty($this->context->language->is_rtl),
            ),
        ));
        $this->context->controller->registerStylesheet('custom-nov-el-css', 'modules/' . $this->name . '/views/css/front.css', ['media' => 'all', 'priority' => 80]);
        $this->context->controller->registerJavascript('custom-nov-el-js', 'modules/' . $this->name . '/views/js/front.js', ['position' => 'bottom', 'priority' => 150]);
    }

    public function hookOverrideLayoutTemplate($params) {
        if (!empty($this->tplOverrided)) {
            return;
        }

        $this->tplOverrided = true;
        $this->registerStylesheets();
        $controller = $this->context->controller;
        $smarty = $this->context->smarty;

        if ($controller->php_self == 'cms') {
            if (isset($smarty->tpl_vars['cms']->value['id'])) {
                $id = $smarty->tpl_vars['cms']->value['id'];
                $content = array('description' => &$smarty->tpl_vars['cms']->value['content']);
            } elseif (isset($controller->cms->id)) {
                $id = $controller->cms->id;
                $content = array('description' => &$controller->cms->content);
            }
        } elseif ($controller->php_self == 'category') {
            if (isset($smarty->tpl_vars['category']->value['id'])) {
                $id = $smarty->tpl_vars['category']->value['id'];
                $content = &$smarty->tpl_vars['category']->value;
            } elseif (Validate::isLoadedObject($category = $controller->getCategory())) {
                $id = $category->id;
                $content = array('description' => &$category->description);
            }
        } elseif ($controller->php_self == 'product') {
            if (isset($smarty->tpl_vars['product']->value['id'])) {
                $id = $smarty->tpl_vars['product']->value['id'];
                $content = &$smarty->tpl_vars['product']->value;
            } elseif (Validate::isLoadedObject($product = $controller->getProduct())) {
                $id = $product->id;
                $content = array('description' => &$product->description);
            }
        }

        if (self::checkAdminToken() && $this->registerEditStylesheets() && strcasecmp(Tools::getValue('cp_type'), 'displayFooterProduct')) {
            if (!empty($id)) {
                $content['description'] = $smarty->fetch(_PS_MODULE_DIR_ . 'novelementor/views/templates/hook/empty_page.tpl');
            }
        } else {
            $this->registerJavascripts();

            if (!empty($id)) {
                $vars = $this->getWidgetVariables($controller->php_self, array('id' => $id));

                if (!empty($vars)) {
                    $smarty->assign($vars[0]);
                    $content['description'] = $smarty->fetch(_PS_MODULE_DIR_ . 'novelementor/views/templates/hook/main_page.tpl');
                }
            }
        }
    }

    public function __call($method, $args) {
        if (stripos($method, 'hookActionObject') === 0 && stripos($method, 'DeleteAfter') !== false) {
            $class = Tools::substr($method, 16, -11);
            $definition = new ReflectionProperty($class, 'definition');

            NovElementorPage::deleteInstance(
                    Tools::strtolower($class), $args[0]['object']->{$definition->getValue(null)['primary']}
            );
        } elseif (stripos($method, 'hook') === 0) {
            return $this->renderWidget(Tools::substr($method, 4), $args);
        } else {
            throw new Exception('Can not find method: ' . $method);
        }
    }

    public function renderWidget($hookName = null, array $config = array()) {
        if (!$hookName) {
            return;
        }

        if (self::checkAdminToken() && !strcasecmp(Tools::getValue('cp_type'), $hookName)) {
            return $this->context->smarty->fetch(_PS_MODULE_DIR_ . 'novelementor/views/templates/hook/empty_page.tpl');
        }

        $out = '';
        $vars = $this->getWidgetVariables($hookName, $config);
        foreach ($vars as &$var) {
            $this->context->smarty->assign($var);
            $out .= $this->context->smarty->fetch(_PS_MODULE_DIR_ . 'novelementor/views/templates/hook/main_page.tpl');
        }
        return $out;
    }

    public function registerEditStylesheets() {
        Helper::registerStylesheet('nov-el-editor-preview', self::VIEWS . "css/editor-preview{$this->dir}{$this->min}.css", array('version' => '1.0.0'));
        Helper::registerStylesheet('nov-el-icons', self::VIEWS . 'lib/eicons/css/elementor-icons.min.css', array('version' => '1.0.0'));
        return true;
    }

    public function registerStylesheets() {
        Helper::registerStylesheet('nov-el-font-awesome', self::VIEWS . 'lib/font-awesome/css/font-awesome.min.css', array('version' => '4.7.0'));
        Helper::registerStylesheet('nov-el-animations', self::VIEWS . 'css/animations.min.css', array('version' => '1.0.0'));
        Helper::registerStylesheet('nov-el-frontend', self::VIEWS . "css/frontend{$this->dir}{$this->min}.css", array('version' => '1.0.0'));
    }

    public function registerJavascripts() {
        Helper::registerJavascript('nov-el-waypoints', self::VIEWS . 'lib/waypoints/waypoints.min.js', array('version' => '2.0.2'));
        Helper::registerJavascript('nov-el-jquery-numerator', self::VIEWS . 'lib/jquery-numerator/jquery-numerator.min.js', array('version' => '0.2.0'));
        Helper::registerJavascript('nov-el-slick', self::VIEWS . "lib/slick/slick{$this->min}.js", array('version' => '1.6.0'));
        Helper::registerJavascript('nov-el-frontend', self::VIEWS . "js/frontend{$this->min}.js", array('version' => '1.0.0'));
    }

    public static function factory($class, $data) {
        $class = '\\NovElementor\\' . $class;
        return new $class($data);
    }

    public static function get_classnumbercolumn($xl_number, $md_number, $number) {
        $class = "";
        if ($xl_number == 5) {
            $class .= 'col-xl-cus-5';
        } else {
            $class .= 'col-xl-' . (12 / $xl_number);
        }
        if ($md_number == 5) {
            $class .= ' col-md-cus-5';
        } else {
            $class .= ' col-md-' . (12 / $md_number);
        }
        if ($number == 5) {
            $class .= ' col-cus-5';
        } else {
            $class .= ' col-' . (12 / $number);
        }
        return $class;
    }

    public static function _getProductIdByDate($beginning, $ending, Context $context = null, $with_combination = false) {
        if (!$context)
            $context = Context::getContext();

        $id_address = $context->cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')};
        $ids = Address::getCountryAndState($id_address);
        $id_country = isset($ids['id_country']) ? $ids['id_country'] : Configuration::get('PS_COUNTRY_DEFAULT');

        return SpecificPrice::getProductIdByDate(
                        $context->shop->id, $context->currency->id, $id_country, $context->customer->id_default_group, $beginning, $ending, 0, $with_combination
        );
    }

    public static function getPricesDrop($filter, $id_lang, $page_number = 0, $nb_products = 10, $count = false, $order_by = null, $order_way = null, $beginning = false, $ending = false, Context $context = null) {
        if (!Validate::isBool($count))
            die(Tools::displayError());

        if (!$context)
            $context = Context::getContext();
        if ($page_number < 0)
            $page_number = 0;
        if ($nb_products < 1)
            $nb_products = 10;
        if (empty($order_by) || $order_by == 'position')
            $order_by = 'price';
        if (empty($order_way))
            $order_way = 'DESC';
        if ($order_by == 'id_product' || $order_by == 'price' || $order_by == 'date_add' || $order_by == 'date_upd')
            $order_by_prefix = 'p';
        else if ($order_by == 'name')
            $order_by_prefix = 'pl';
        if (!Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way))
            die(Tools::displayError());
        $current_date = date('Y-m-d H:i:s');
        $ids_product = self::_getProductIdByDate((!$beginning ? $current_date : $beginning), (!$ending ? $current_date : $ending), $context);

        $tab_id_product = array();
        foreach ($ids_product as $product)
            if (is_array($product))
                $tab_id_product[] = (int) $product['id_product'];
            else
                $tab_id_product[] = (int) $product;

        $front = true;
        if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
            $front = false;

        $sql_groups = '';
        if (Group::isFeatureActive()) {
            $groups = FrontController::getCurrentCustomerGroups();
            $sql_groups = 'AND p.`id_product` IN (
                SELECT cp.`id_product`
                FROM `' . _DB_PREFIX_ . 'category_group` cg
                LEFT JOIN `' . _DB_PREFIX_ . 'category_product` cp ON (cp.`id_category` = cg.`id_category`)
                WHERE cg.`id_group` ' . (count($groups) ? 'IN (' . implode(',', $groups) . ')' : '= 1') . (($filter && $filter != '') ? (' AND ' . $filter) : ' ') . '
            )';
        }

        if ($count) {
            return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('
            SELECT COUNT(DISTINCT p.`id_product`)
            FROM `' . _DB_PREFIX_ . 'product` p
            ' . Shop::addSqlAssociation('product', 'p') . '
            WHERE product_shop.`active` = 1
            AND product_shop.`show_price` = 1
            ' . ($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '') . '
            ' . ((!$beginning && !$ending) ? 'AND p.`id_product` IN(' . ((is_array($tab_id_product) && count($tab_id_product)) ? implode(', ', $tab_id_product) : 0) . ')' : '') . '
            ' . $sql_groups);
        }

        if (strpos($order_by, '.') > 0) {
            $order_by = explode('.', $order_by);
            $order_by = pSQL($order_by[0]) . '.`' . pSQL($order_by[1]) . '`';
        }

        $sql = '
        SELECT
            p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, pl.`description`, pl.`description_short`,
            MAX(product_attribute_shop.id_product_attribute) id_product_attribute,
            pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`,
            pl.`name`, MAX(image_shop.`id_image`) id_image, il.`legend`, m.`name` AS manufacturer_name,
            DATEDIFF(
                p.`date_add`,
                DATE_SUB(
                    NOW(),
                    INTERVAL ' . (Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20) . ' DAY
                )
            ) > 0 AS new
        FROM `' . _DB_PREFIX_ . 'product` p
        ' . Shop::addSqlAssociation('product', 'p') . '
        LEFT JOIN ' . _DB_PREFIX_ . 'product_attribute pa ON (pa.id_product = p.id_product)
        ' . Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.default_on=1') . '
        ' . Product::sqlStock('p', 0, false, $context->shop) . '
        LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (
            p.`id_product` = pl.`id_product`
            AND pl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('pl') . '
        )
        LEFT JOIN `' . _DB_PREFIX_ . 'image` i ON (i.`id_product` = p.`id_product`)' .
                Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1') . '
        LEFT JOIN `' . _DB_PREFIX_ . 'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = ' . (int) $id_lang . ')
        LEFT JOIN `' . _DB_PREFIX_ . 'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
        WHERE product_shop.`active` = 1
        AND product_shop.`show_price` = 1
        ' . ($front ? ' AND p.`visibility` IN ("both", "catalog")' : '') . '
        ' . ((!$beginning && !$ending) ? ' AND p.`id_product` IN (' . ((is_array($tab_id_product) && count($tab_id_product)) ? implode(', ', $tab_id_product) : 0) . ')' : '') . '
        ' . $sql_groups . '
        GROUP BY product_shop.id_product
        ORDER BY ' . (isset($order_by_prefix) ? pSQL($order_by_prefix) . '.' : '') . pSQL($order_by) . ' ' . pSQL($order_way) . '
        LIMIT ' . (int) ($page_number * $nb_products) . ', ' . (int) $nb_products;

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        if (!$result)
            return false;

        if ($order_by == 'price')
            Tools::orderbyPrice($result, $order_way);

        return Product::getProductsProperties($id_lang, $result);
    }

    public static function getConfigTheme() {
        $novconfig = array();
        if (!file_exists(_PS_MODULE_DIR_ . '/novthemeconfig/novthemeconfig.php')) {
            return $novconfig;
        }
        require_once(_PS_MODULE_DIR_ . '/novthemeconfig/novthemeconfig.php');
        $NovThemeConfig = new ThemeConfig;
        $defaults = $NovThemeConfig->getThemeFields();
        $context = Context::getContext();
        $id_lang = Context::getContext()->language->id;
        foreach ($defaults as $key => $value) {
            if (is_array($value)) {
                $novconfig[$key] = Configuration::get($key, $context->language->id);
            } else {
                $prefix_key = str_replace('novthemeconfig_', '', $key);
                $novconfig[$key] = Configuration::get($key);
                if (Tools::getValue($prefix_key)) {
                    Tools::clearSmartyCache();
                    $novconfig[$key] = Tools::getValue($prefix_key);
                    $context->cookie->__set($prefix_key, Tools::getValue($prefix_key));
                }

                if ($context->cookie->__get($prefix_key)) {
                    $novconfig[$key] = $context->cookie->__get($prefix_key);
                }
            }
        }
        return $novconfig;
    }

    public static function getLookbook($filter = null) {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $id_shop = $context->shop->id;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT hs.`id_novlookbook_slides` as id_slide, hss.`image`,hss.`width`,hss.`height`, hss.`position`,hss.`active`,hss.`hotsposts`, hssl.`title`, hssl.`description` 
        FROM ' . _DB_PREFIX_ . 'novlookbook hs 
        LEFT JOIN ' . _DB_PREFIX_ . 'novlookbook_slides hss 
        ON (hs.id_novlookbook_slides = hss.id_novlookbook_slides) 
        LEFT JOIN ' . _DB_PREFIX_ . 'novlookbook_slides_lang hssl ON (hss.id_novlookbook_slides = hssl.id_novlookbook_slides) 
        WHERE id_shop = ' . (int) $id_shop . ' 
        AND hssl.id_lang = ' . (int) $id_lang . '
        AND hss.`active` = 1
        ' . $filter . '
        ORDER BY hss.position');
    }

    public static function NovgetProducts($filter, $id_lang, $page_number = 0, $nb_products = 10, $count = false, $order_by = null, $order_way = null, Context $context = null) {
        $now = date('Y-m-d') . ' 00:00:00';
        if (!$context) {
            $context = Context::getContext();
        }

        $front = true;
        if (!in_array($context->controller->controller_type, array('front', 'modulefront'))) {
            $front = false;
        }

        if ($page_number < 1) {
            $page_number = 1;
        }
        if ($nb_products < 1) {
            $nb_products = 10;
        }
        if (empty($order_by) || $order_by == 'position') {
            $order_by = 'date_add';
        }
        if (empty($order_way)) {
            $order_way = 'DESC';
        }
        if ($order_by == 'id_product' || $order_by == 'price' || $order_by == 'date_add' || $order_by == 'date_upd') {
            $order_by_prefix = 'product_shop';
        } elseif ($order_by == 'name') {
            $order_by_prefix = 'pl';
        }
        if (!Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way)) {
            die(Tools::displayError());
        }

        $sql_groups = '';
        if (Group::isFeatureActive()) {
            $groups = FrontController::getCurrentCustomerGroups();
            $sql_groups = ' AND EXISTS(SELECT 1 FROM `' . _DB_PREFIX_ . 'category_product` cp
                JOIN `' . _DB_PREFIX_ . 'category_group` cg ON (cp.id_category = cg.id_category AND cg.`id_group` ' . (count($groups) ? 'IN (' . implode(',', $groups) . ')' : '= ' . (int) Configuration::get('PS_UNIDENTIFIED_GROUP')) . ')
                WHERE cp.`id_product` = p.`id_product`)';
        }

        if (strpos($order_by, '.') > 0) {
            $order_by = explode('.', $order_by);
            $order_by_prefix = $order_by[0];
            $order_by = $order_by[1];
        }

        $nb_days_new_product = (int) Configuration::get('PS_NB_DAYS_NEW_PRODUCT');

        if ($count) {
            $sql = 'SELECT COUNT(p.`id_product`) AS nb
                    FROM `' . _DB_PREFIX_ . 'product` p
                    ' . Shop::addSqlAssociation('product', 'p') . '
                    WHERE product_shop.`active` = 1
                    ' . ($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '') . '
                    ' . $sql_groups;

            return (int) Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        }
        $sql = new DbQuery();
        $sql->select(
                'p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, pl.`description`, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`,
            pl.`meta_keywords`, pl.`meta_title`, pl.`name`, pl.`available_now`, pl.`available_later`, image_shop.`id_image` id_image, il.`legend`, m.`name` AS manufacturer_name,
            (DATEDIFF(product_shop.`date_add`,
                DATE_SUB(
                    "' . $now . '",
                    INTERVAL ' . $nb_days_new_product . ' DAY
                )
            ) > 0) as new'
        );

        $sql->from('product', 'p');
        $sql->join(Shop::addSqlAssociation('product', 'p'));
        $sql->leftJoin('product_lang', 'pl', '
            p.`id_product` = pl.`id_product`
            AND pl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('pl')
        );
        $sql->leftJoin('image_shop', 'image_shop', 'image_shop.`id_product` = p.`id_product` AND image_shop.cover=1 AND image_shop.id_shop=' . (int) $context->shop->id);
        $sql->leftJoin('image_lang', 'il', 'image_shop.`id_image` = il.`id_image` AND il.`id_lang` = ' . (int) $id_lang);
        $sql->leftJoin('manufacturer', 'm', 'm.`id_manufacturer` = p.`id_manufacturer`');
        $sql->leftJoin('category_product', 'cp', 'cp.`id_product` = p.`id_product`');

        $sql->where('product_shop.`active` = 1');
        if ($filter != '') {
            $sql->where($filter);
        }
        if ($front) {
            $sql->where('product_shop.`visibility` IN ("both", "catalog")');
        }

        if (Group::isFeatureActive()) {
            $groups = FrontController::getCurrentCustomerGroups();
            $sql->where('EXISTS(SELECT 1 FROM `' . _DB_PREFIX_ . 'category_product` cp
                JOIN `' . _DB_PREFIX_ . 'category_group` cg ON (cp.id_category = cg.id_category AND cg.`id_group` ' . (count($groups) ? 'IN (' . implode(',', $groups) . ')' : '= 1') . ')
                WHERE cp.`id_product` = p.`id_product`)');
        }

        $sql->groupBy('p.`id_product`');

        $sql->orderBy((isset($order_by_prefix) ? pSQL($order_by_prefix) . '.' : '') . '`' . pSQL($order_by) . '` ' . pSQL($order_way));
        $sql->limit($nb_products, (int) (($page_number - 1) * $nb_products));

        if (Combination::isFeatureActive()) {
            $sql->select('product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, IFNULL(product_attribute_shop.id_product_attribute,0) id_product_attribute');
            $sql->leftJoin('product_attribute_shop', 'product_attribute_shop', 'p.`id_product` = product_attribute_shop.`id_product` AND product_attribute_shop.`default_on` = 1 AND product_attribute_shop.id_shop=' . (int) $context->shop->id);
        }
        $sql->join(Product::sqlStock('p', 0));

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        if (!$result) {
            return false;
        }

        if ($order_by == 'price') {
            Tools::orderbyPrice($result, $order_way);
        }
        $products_ids = array();
        foreach ($result as $row) {
            $products_ids[] = $row['id_product'];
        }
        // Thus you can avoid one query per product, because there will be only one query for all the products of the cart
        Product::cacheFrontFeatures($products_ids, $id_lang);

        return Product::getProductsProperties((int) $id_lang, $result);
    }

    public static function getBestSales($filter, $idLang, $pageNumber = 0, $nbProducts = 10, $orderBy = null, $orderWay = null, Context $context = null) {
        if (!$context)
            $context = Context::getContext();

        if ($pageNumber < 1) {
            $pageNumber = 1;
        }
        if ($nbProducts < 1) {
            $nbProducts = 10;
        }
        $finalOrderBy = $orderBy;
        $orderTable = '';

        $invalidOrderBy = !Validate::isOrderBy($orderBy);
        if ($invalidOrderBy || is_null($orderBy)) {
            $orderBy = 'quantity';
            $orderTable = 'ps';
        }

        if ($orderBy == 'date_add' || $orderBy == 'date_upd') {
            $orderTable = 'product_shop';
        }

        $invalidOrderWay = !Validate::isOrderWay($orderWay);
        if ($invalidOrderWay || is_null($orderWay) || $orderBy == 'sales') {
            $orderWay = 'DESC';
        }

        $interval = Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20;

        // no group by needed : there's only one attribute with default_on=1 for a given id_product + shop
        // same for image with cover=1
        $sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity,
                    ' . (Combination::isFeatureActive() ? 'product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity,IFNULL(product_attribute_shop.id_product_attribute,0) id_product_attribute,' : '') . '
                    pl.`description`, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`,
                    pl.`meta_keywords`, pl.`meta_title`, pl.`name`, pl.`available_now`, pl.`available_later`,
                    m.`name` AS manufacturer_name, p.`id_manufacturer` as id_manufacturer,
                    image_shop.`id_image` id_image, il.`legend`,
                    ps.`quantity` AS sales, t.`rate`, pl.`meta_keywords`, pl.`meta_title`, pl.`meta_description`,
                    DATEDIFF(p.`date_add`, DATE_SUB("' . date('Y-m-d') . ' 00:00:00",
                    INTERVAL ' . (int) $interval . ' DAY)) > 0 AS new'
                . ' FROM `' . _DB_PREFIX_ . 'product_sale` ps
                LEFT JOIN `' . _DB_PREFIX_ . 'product` p ON ps.`id_product` = p.`id_product`
                ' . Shop::addSqlAssociation('product', 'p', false);
        if (Combination::isFeatureActive()) {
            $sql .= ' LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute_shop` product_attribute_shop
                            ON (p.`id_product` = product_attribute_shop.`id_product` AND product_attribute_shop.`default_on` = 1 AND product_attribute_shop.id_shop=' . (int) $context->shop->id . ')';
        }

        $sql .= ' LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl
                    ON p.`id_product` = pl.`id_product`
                    AND pl.`id_lang` = ' . (int) $idLang . Shop::addSqlRestrictionOnLang('pl') . '
                LEFT JOIN `' . _DB_PREFIX_ . 'image_shop` image_shop
                    ON (image_shop.`id_product` = p.`id_product` AND image_shop.cover=1 AND image_shop.id_shop=' . (int) $context->shop->id . ')
                LEFT JOIN `' . _DB_PREFIX_ . 'category_product` cp ON (cp.`id_product` = p.`id_product`)
                LEFT JOIN `' . _DB_PREFIX_ . 'image_lang` il ON (image_shop.`id_image` = il.`id_image` AND il.`id_lang` = ' . (int) $idLang . ')
                LEFT JOIN `' . _DB_PREFIX_ . 'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
                LEFT JOIN `' . _DB_PREFIX_ . 'tax_rule` tr ON (product_shop.`id_tax_rules_group` = tr.`id_tax_rules_group`)
                    AND tr.`id_country` = ' . (int) $context->country->id . '
                    AND tr.`id_state` = 0
                LEFT JOIN `' . _DB_PREFIX_ . 'tax` t ON (t.`id_tax` = tr.`id_tax`)
                ' . Product::sqlStock('p', 0);

        $sql .= '
                WHERE product_shop.`active` = 1 AND ' . $filter . '
                    AND product_shop.`visibility` != \'none\'';

        if (Group::isFeatureActive()) {
            $groups = FrontController::getCurrentCustomerGroups();
            $sql .= ' AND EXISTS(SELECT 1 FROM `' . _DB_PREFIX_ . 'category_product` cp
                    JOIN `' . _DB_PREFIX_ . 'category_group` cg ON (cp.id_category = cg.id_category AND cg.`id_group` ' . (count($groups) ? 'IN (' . implode(',', $groups) . ')' : '= 1') . ')
                    WHERE cp.`id_product` = p.`id_product`)';
        }

        if ($finalOrderBy != 'price') {
            $sql .= '
                    ORDER BY ' . (!empty($orderTable) ? '`' . pSQL($orderTable) . '`.' : '') . '`' . pSQL($orderBy) . '` ' . pSQL($orderWay) . '
                    LIMIT ' . (int) (($pageNumber - 1) * $nbProducts) . ', ' . (int) $nbProducts;
        }

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        if ($finalOrderBy == 'price') {
            Tools::orderbyPrice($result, $orderWay);
            $result = array_slice($result, (int) (($pageNumber - 1) * $nbProducts), (int) $nbProducts);
        }
        if (!$result) {
            return false;
        }

        return Product::getProductsProperties($idLang, $result);
    }
public static function NovgetBlogs($filter, $limit = 12, $order_by = null, $order_way = null, $catids) {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $id_shop = $context->shop->id;

        $result = array();
        $sql = new DbQuery();
        $sql->select('p.*, pl.meta_title, pl.meta_description, pl.short_description, pl.content, pl.link_rewrite'); 
        $sql->from('smart_blog_post', 'p');
        $sql->innerJoin('smart_blog_post_lang', 'pl', 'pl.`id_smart_blog_post` = p.`id_smart_blog_post`');
        $sql->innerJoin('smart_blog_post_shop', 'ps', 'pl.`id_smart_blog_post` = ps.`id_smart_blog_post`');
        $sql->leftJoin('smart_blog_post_category', 'sbpc', 'sbpc.`id_smart_blog_post` = p.`id_smart_blog_post`');
        $sql->leftJoin('smart_blog_post_tag', 'sbpt', 'sbpt.`id_post` = p.`id_smart_blog_post`');
        $sql->where('ps.`id_shop` = ' . (int) $id_shop);
        $sql->where('pl.`id_lang` = ' . (int) $id_lang);
        $sql->where('p.`active` = 1');

        if (!empty($catids)) {
            $sql->where('sbpc.`id_smart_blog_category` IN (' . implode(',', $catids) . ')');
        }

        $sql->groupBy('p.`id_smart_blog_post`');
        if (isset($order_by) && !empty($order_by)) {
            if ($order_by == 'meta_title' || $order_by == 'link_rewrite') {
                $orderby = 'pl.`' . $order_by . '`';
            } elseif ($order_by == 'date') {
                $order_by = 'created';
                $orderby = 'p.`' . $order_by . '`';
            } else {
                $orderby = 'p.`' . $order_by . '`';
            }
        }
        $sql->orderBy(pSQL($order_by) . ' ' . pSQL($order_way));
        $sql->limit($limit);

        $posts = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        $blogcomment = new Blogcomment();

        $i = 0;
        foreach ($posts as $post) {
            $result[$i]['id'] = $post['id_smart_blog_post'];
            $result[$i]['title'] = $post['meta_title'];
            $result[$i]['meta_description'] = strip_tags($post['meta_description']);
            $result[$i]['short_description'] = strip_tags($post['short_description']);
            $result[$i]['content'] = strip_tags($post['content']);
            $result[$i]['category'] = $post['id_category'];
            $result[$i]['date_added'] = Smartblog::displayDate($post['created']);
            $result[$i]['viewed'] = $post['viewed'];
            $result[$i]['is_featured'] = $post['is_featured'];
            $result[$i]['link_rewrite'] = $post['link_rewrite'];
            $result[$i]['countcomment'] = $blogcomment->getToltalComment($post['id_smart_blog_post']);
            $employee = new Employee($post['id_author']);
            $result[$i]['lastname'] = $employee->lastname;
            $result[$i]['firstname'] = $employee->firstname;
            if (file_exists(_PS_MODULE_DIR_ . 'smartblog/images/' . $post['id_smart_blog_post'] . '.jpg')) {
                $image = $post['id_smart_blog_post'];
                $result[$i]['post_img'] = $image;
            } else {
                $result[$i]['post_img'] = 'no';
            }
            $i++;
        }
        return $result;
    }
    public static function getTestimonialss($active = null, $limit = 12) {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $id_shop = $context->shop->id;

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
            SELECT hs.`id_novtestimonials` as id_novtestimonials, hssl.`image`,hs.`name`,hs.`email`, hs.`company`, hs.`address`, hs.`position`, hs.`active`, hssl.`content`,
            hssl.`url`, hssl.`image`
            FROM ' . _DB_PREFIX_ . 'novtestimonials  hs
            LEFT JOIN ' . _DB_PREFIX_ . 'novtestimonials_shop hss ON (hs.id_novtestimonials = hss.id_novtestimonials)
            LEFT JOIN ' . _DB_PREFIX_ . 'novtestimonials_lang hssl ON (hss.id_novtestimonials = hssl.id_novtestimonials)
            WHERE id_shop = ' . (int) $id_shop . '
            AND hssl.id_lang = ' . (int) $id_lang .
                        ($active ? ' AND hs.`active` = 1' : ' ') . '
            ORDER BY hs.position LIMIT ' . $limit
        );
    }

    public static function getNewProducts($filter, $id_lang, $page_number = 0, $nb_products = 10, $count = false, $order_by = null, $order_way = null, Context $context = null) {
        if (!$context)
            $context = Context::getContext();

        $front = true;
        if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
            $front = false;

        if ($page_number < 0)
            $page_number = 0;
        if ($nb_products < 1)
            $nb_products = 10;
        if (empty($order_by) || $order_by == 'position')
            $order_by = 'date_add';
        if (empty($order_way))
            $order_way = 'DESC';
        if ($order_by == 'id_product' || $order_by == 'price' || $order_by == 'date_add' || $order_by == 'date_upd')
            $order_by_prefix = 'p';
        else if ($order_by == 'name')
            $order_by_prefix = 'pl';
        if (!Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way))
            die(Tools::displayError());

        $sql_groups = '';
        if (Group::isFeatureActive()) {
            $groups = FrontController::getCurrentCustomerGroups();
            $sql_groups = 'AND p.`id_product` IN (
					SELECT cp.`id_product`
					FROM `' . _DB_PREFIX_ . 'category_group` cg
					LEFT JOIN `' . _DB_PREFIX_ . 'category_product` cp ON (cp.`id_category` = cg.`id_category`)
					WHERE cg.`id_group` ' . (count($groups) ? 'IN (' . implode(',', $groups) . ')' : '= 1') . '
				)';
        }

        if (strpos($order_by, '.') > 0) {
            $order_by = explode('.', $order_by);
            $order_by_prefix = $order_by[0];
            $order_by = $order_by[1];
        }

        if ($count) {
            $sql = 'SELECT COUNT(p.`id_product`) AS nb
						FROM `' . _DB_PREFIX_ . 'product` p
						' . Shop::addSqlAssociation('product', 'p') . '
						WHERE product_shop.`active` = 1
						' . ($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '') . '
						' . $sql_groups;
            return (int) Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        }

        $sql = new DbQuery();
        $sql->select(
                'p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, pl.`description`, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`,
				pl.`meta_keywords`, pl.`meta_title`, pl.`name`, pl.`available_now`, pl.`available_later`, MAX(image_shop.`id_image`) id_image, il.`legend`, m.`name` AS manufacturer_name,
				product_shop.`date_add` > "' . date('Y-m-d', strtotime('-' . (Configuration::get('PS_NB_DAYS_NEW_PRODUCT') ? (int) Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20) . ' DAY')) . '" as new'
        );

        $sql->from('product', 'p');
        $sql->join(Shop::addSqlAssociation('product', 'p'));
        $sql->leftJoin('product_lang', 'pl', '
				p.`id_product` = pl.`id_product`
				AND pl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('pl')
        );
        $sql->leftJoin('image', 'i', 'i.`id_product` = p.`id_product`');
        $sql->join(Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1'));
        $sql->leftJoin('image_lang', 'il', 'i.`id_image` = il.`id_image` AND il.`id_lang` = ' . (int) $id_lang);
        $sql->leftJoin('manufacturer', 'm', 'm.`id_manufacturer` = p.`id_manufacturer`');
        $sql->leftJoin('category_product', 'cp', 'cp.`id_product` = p.`id_product`');
        
       // $sql->leftJoin('ps_product_attribute_combination', 'pac', 'pac.`ps_product_attribute` = p.`id_product`');
        
        $sql->where('product_shop.`active` = 1' . $filter);
//                $sql->where('product_shop.`active` = 1');
//        $sql->where($filter);
        if ($front)
            $sql->where('product_shop.`visibility` IN ("both", "catalog")');
        //$sql->where('product_shop.`date_add` > "'.date('Y-m-d', strtotime('-'.(Configuration::get('PS_NB_DAYS_NEW_PRODUCT') ? (int)Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY')).'"');
        if (Group::isFeatureActive())
            $sql->where('p.`id_product` IN (
					SELECT cp.`id_product`
					FROM `' . _DB_PREFIX_ . 'category_group` cg
					LEFT JOIN `' . _DB_PREFIX_ . 'category_product` cp ON (cp.`id_category` = cg.`id_category`)
					WHERE cg.`id_group` ' . $sql_groups . '
				)');
        $sql->groupBy('product_shop.id_product');

        $sql->orderBy((isset($order_by_prefix) ? pSQL($order_by_prefix) . '.' : '') . '`' . pSQL($order_by) . '` ' . pSQL($order_way));
        $sql->limit($nb_products, $page_number * $nb_products);

        if (Combination::isFeatureActive()) {
            $sql->select('MAX(product_attribute_shop.id_product_attribute) id_product_attribute');
            $sql->leftOuterJoin('product_attribute', 'pa', 'p.`id_product` = pa.`id_product`');
            $sql->join(Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.default_on = 1'));
        }
        $sql->join(Product::sqlStock('p', Combination::isFeatureActive() ? 'product_attribute_shop' : 0));

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        if ($order_by == 'price')
            Tools::orderbyPrice($result, $order_way);
        if (!$result)
            return false;

        $products_ids = array();
        foreach ($result as $row)
            $products_ids[] = $row['id_product'];
        // Thus you can avoid one query per product, because there will be only one query for all the products of the cart
        Product::cacheFrontFeatures($products_ids, $id_lang);
        return Product::getProductsProperties((int) $id_lang, $result);
    }

    public static function getSingleProduct($id_lang, $nov_idproduct, Context $context = null) {
        if (!$context)
            $context = Context::getContext();

        $front = true;
        if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
            $front = false;
       
        $sql = new DbQuery();
        $sql->select(
                'p.*, product_shop.*, pl.`description`, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`,
                pl.`meta_keywords`, pl.`meta_title`, pl.`name`, pl.`available_now`, pl.`available_later`, MAX(image_shop.`id_image`) id_image, il.`legend`, m.`name` AS manufacturer_name,
                product_shop.`date_add` > "' . date('Y-m-d', strtotime('-' . (Configuration::get('PS_NB_DAYS_NEW_PRODUCT') ? (int) Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20) . ' DAY')) . '" as new');

        $sql->from('product', 'p');
        $sql->join(Shop::addSqlAssociation('product', 'p'));
        $sql->leftJoin('product_lang', 'pl', '
                p.`id_product` = pl.`id_product`
                AND pl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('pl')
        );
        $sql->leftJoin('image', 'i', 'i.`id_product` = p.`id_product`');
        $sql->join(Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1'));
        $sql->leftJoin('image_lang', 'il', 'i.`id_image` = il.`id_image` AND il.`id_lang` = ' . (int) $id_lang);
        $sql->leftJoin('manufacturer', 'm', 'm.`id_manufacturer` = p.`id_manufacturer`');
        $sql->leftJoin('category_product', 'cp', 'cp.`id_product` = p.`id_product`');
        
        $sql->where('p.`id_product` = '.$nov_idproduct);
       
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        if (!$result)
            return false;

        return Product::getProductsProperties((int) $id_lang, $result);
    }

    public static function getSpecialProducts($filter, $categories, $p = 1, $n, $active = true, Context $context = null, $type = 'toprating') {
        if (!$context)
            $context = Context::getContext();
        $id_lang = $context->language->id;

        $front = true;
        if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
            $front = false;

        if ($p < 1)
            $p = 1;

        $id_supplier = (int) Tools::getValue('id_supplier');

        $sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, MAX(product_attribute_shop.id_product_attribute) id_product_attribute, product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, pl.`description`, pl.`description_short`, pl.`available_now`,
		                pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, MAX(image_shop.`id_image`) id_image,
		                il.`legend`, m.`name` AS manufacturer_name, cl.`name` AS category_default,
		                DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
		                INTERVAL ' . (Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20) . '
		                    DAY)) > 0 AS new, product_shop.price AS orderprice' . ($type == 'mostview' ? ', count(cnn.id_connections) as pages' : '') . ($type == 'toprating' ? ', AVG(pc.grade) as avg_grade' : '') . '
		            FROM `' . _DB_PREFIX_ . 'category_product` cp
		            LEFT JOIN `' . _DB_PREFIX_ . 'product` p
		                ON p.`id_product` = cp.`id_product`
		            ' . Shop::addSqlAssociation('product', 'p') . '
		            LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute` pa
		            ON (p.`id_product` = pa.`id_product`)
		            ' . Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1') . '
		            ' . Product::sqlStock('p', 'product_attribute_shop', false, $context->shop) . '
		            LEFT JOIN `' . _DB_PREFIX_ . 'category_lang` cl
		                ON (product_shop.`id_category_default` = cl.`id_category`
		                AND cl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('cl') . ')
		            LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl
		                ON (p.`id_product` = pl.`id_product`
		                AND pl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('pl') . ')
		            LEFT JOIN `' . _DB_PREFIX_ . 'image` i
		                ON (i.`id_product` = p.`id_product`)' .
                Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1') . '
		            LEFT JOIN `' . _DB_PREFIX_ . 'image_lang` il
		                ON (image_shop.`id_image` = il.`id_image`
		                AND il.`id_lang` = ' . (int) $id_lang . ')
		            LEFT JOIN `' . _DB_PREFIX_ . 'manufacturer` m
		                ON m.`id_manufacturer` = p.`id_manufacturer`

		            ' . ($type == 'mostview' ? '
					LEFT JOIN `' . _DB_PREFIX_ . 'page` pag ON (cp.id_product = pag.id_object)
					LEFT JOIN `' . _DB_PREFIX_ . 'connections` cnn ON (cnn.id_page = pag.id_page)
					LEFT JOIN `' . _DB_PREFIX_ . 'page_type` pat ON (pat.id_page_type = pag.id_page_type)
					' : '') .
                ($type == 'toprating' ? '
					JOIN `' . _DB_PREFIX_ . 'product_comment` pc ON (cp.id_product = pc.id_product AND pc.validate = 1)
					' : '') . '

		            WHERE product_shop.`id_shop` = ' . (int) $context->shop->id . ($type == 'mostview' ? ' AND pat.`name` = \'product\'' : '')
                . ($active ? ' AND product_shop.`active` = 1' : '')
                . ($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '')
                . ($id_supplier ? ' AND p.id_supplier = ' . (int) $id_supplier : '')
                . $filter;

        if ($type == 'mostview') {
            $sql .= ' GROUP BY cnn.id_page';
            $sql .= ' ORDER BY pages DESC ';
        } elseif ($type == 'toprating') {
            $sql .= ' GROUP BY product_shop.id_product ';
            $sql .= ' ORDER BY avg_grade DESC ';
        }
        $sql .= ' LIMIT ' . (((int) $p - 1) * (int) $n) . ',' . (int) $n;
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        if (!$result)
            return array();
        /* Modify SQL result */
        return Product::getProductsProperties($id_lang, $result);
    }

    public function getFilterProducts($filter_category, $filter_manufacture, $filter_attribute, $filter_price, $id_lang, $page_number = 0, $nb_products = 10, $numberload = 4, $count = false, $order_by = null, $order_way = null, Context $context = null) {
        if (!$context)
            $context = Context::getContext();

        $front = true;
        if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
            $front = false;

        if ($page_number < 0)
            $page_number = 0;
        if ($nb_products < 1)
            $nb_products = 10;
        if (empty($order_by) || $order_by == 'position')
            $order_by = 'date_add';
        if (empty($order_way))
            $order_way = 'DESC';
        if ($order_by == 'id_product' || $order_by == 'price' || $order_by == 'date_add' || $order_by == 'date_upd')
            $order_by_prefix = 'p';
        else if ($order_by == 'name')
            $order_by_prefix = 'pl';
        if (!Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way))
            die(Tools::displayError());

        $sql_groups = '';
        if (Group::isFeatureActive()) {
            $groups = FrontController::getCurrentCustomerGroups();
            $sql_groups = 'AND p.`id_product` IN (
				SELECT cp.`id_product`
				FROM `' . _DB_PREFIX_ . 'category_group` cg
				LEFT JOIN `' . _DB_PREFIX_ . 'category_product` cp ON (cp.`id_category` = cg.`id_category`)
				WHERE cg.`id_group` ' . (count($groups) ? 'IN (' . implode(',', $groups) . ')' : '= 1') . ' 
			)';
        }

        if (strpos($order_by, '.') > 0) {
            $order_by = explode('.', $order_by);
            $order_by_prefix = $order_by[0];
            $order_by = $order_by[1];
        }

        if ($count) {
            $sql = 'SELECT COUNT(p.`id_product`) AS nb
					FROM `' . _DB_PREFIX_ . 'product` p
					' . Shop::addSqlAssociation('product', 'p') . '
					WHERE product_shop.`active` = 1
					AND product_shop.`date_add` > "' . date('Y-m-d', strtotime('-' . (Configuration::get('PS_NB_DAYS_NEW_PRODUCT') ? (int) Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20) . ' DAY')) . '"
					' . ($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '') . '
					' . $sql_groups;
            return (int) Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        }

        $sql = new DbQuery();
        $sql->select(
                'p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, pl.`description`, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`,
			pl.`meta_keywords`, pl.`meta_title`, pl.`name`, pl.`available_now`, pl.`available_later`, MAX(image_shop.`id_image`) id_image, il.`legend`, m.`name` AS manufacturer_name,
			product_shop.`date_add` > "' . date('Y-m-d', strtotime('-' . (Configuration::get('PS_NB_DAYS_NEW_PRODUCT') ? (int) Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20) . ' DAY')) . '" as new'
        );

        $sql->from('product', 'p');
        $sql->join(Shop::addSqlAssociation('product', 'p'));
        $sql->leftJoin('product_lang', 'pl', '
			p.`id_product` = pl.`id_product`
			AND pl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('pl')
        );
        $sql->leftJoin('image', 'i', 'i.`id_product` = p.`id_product`');
        $sql->join(Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1'));
        $sql->leftJoin('image_lang', 'il', 'i.`id_image` = il.`id_image` AND il.`id_lang` = ' . (int) $id_lang);
        $sql->leftJoin('manufacturer', 'm', 'm.`id_manufacturer` = p.`id_manufacturer`');
        $sql->leftJoin('category_product', 'cp', 'cp.`id_product` = p.`id_product`');
        $sql->leftJoin('layered_product_attribute', 'lpa', 'lpa.`id_product` = p.`id_product`');

        $sql->where('product_shop.`active` = 1' . $filter_category . $filter_manufacture . $filter_attribute . $filter_price);
        if ($front)
            $sql->where('product_shop.`visibility` IN ("both", "catalog")');
        // $sql->where('product_shop.`date_add` > "'.date('Y-m-d', strtotime('-'.(Configuration::get('PS_NB_DAYS_NEW_PRODUCT') ? (int)Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY')).'"');
        if (Group::isFeatureActive())
            $sql->where('p.`id_product` IN (
				SELECT cp.`id_product`
				FROM `' . _DB_PREFIX_ . 'category_group` cg
				LEFT JOIN `' . _DB_PREFIX_ . 'category_product` cp ON (cp.`id_category` = cg.`id_category`)
				WHERE cg.`id_group` ' . $sql_groups . '
			)');
        $sql->groupBy('product_shop.id_product');

        $sql->orderBy((isset($order_by_prefix) ? pSQL($order_by_prefix) . '.' : '') . '`' . pSQL($order_by) . '` ' . pSQL($order_way));
        if ($page_number == 0) {
            $sql->limit($nb_products, 0);
        } else {
            $sql->limit($numberload, $nb_products + ( ($page_number - 1) * $numberload));
        }

        if (Combination::isFeatureActive()) {
            $sql->select('MAX(product_attribute_shop.id_product_attribute) id_product_attribute');
            $sql->leftOuterJoin('product_attribute', 'pa', 'p.`id_product` = pa.`id_product`');
            $sql->join(Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.default_on = 1'));
        }
        $sql->join(Product::sqlStock('p', Combination::isFeatureActive() ? 'product_attribute_shop' : 0));
        // echo $sql;die();
        // echo"<pre>".print_r($sql,1);die();
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        // var_dump($result);die('vao');
        if ($order_by == 'price')
            Tools::orderbyPrice($result, $order_way);
        if (!$result)
            return false;

        $products_ids = array();
        //echo"<pre>".print_r($result,1);die();
        foreach ($result as $row)
            $products_ids[] = $row['id_product'];
        // Thus you can avoid one query per product, because there will be only one query for all the products of the cart
        Product::cacheFrontFeatures($products_ids, $id_lang);
        return Product::getProductsProperties((int) $id_lang, $result);
    }

    public function ajaxFilterProduct($id_category, $id_manufacture, $id_attribute, $orderby, $limit, $count_showmore, $numberload, $min_price, $max_price) {
        $id_language = Context::getContext()->language->id;
        $filter_category = $filter_manufacture = $filter_attribute = $filter_price = "";
        if ($id_category && $id_category != 0) {
            $id_category = explode(',', $id_category);
            $filter_category = ' AND cp.id_category IN (' . implode(',', $id_category) . ') ';
        }
        if ($id_manufacture)
            $filter_manufacture = ' AND m.id_manufacturer IN (' . pSQL($id_manufacture) . ') ';
        if ($id_attribute)
            $filter_attribute = ' AND lpa.id_attribute IN (' . pSQL($id_attribute) . ') ';
        if ($min_price && $max_price)
            $filter_price = ' AND p.price BETWEEN ' . (float) ($min_price) . ' AND ' . (float) ($max_price) . '';
        $orderway = "DESC";
        $products = $this->getFilterProducts($filter_category, $filter_manufacture, $filter_attribute, $filter_price, $id_language, $count_showmore, $limit, $numberload, false, $orderby, $orderway);
        $assembler = new \ProductAssembler(Context::getContext());
        $presenterFactory = new \ProductPresenterFactory(Context::getContext());
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = new \PrestaShop\PrestaShop\Adapter\Presenter\Product\ProductListingPresenter(
                new \PrestaShop\PrestaShop\Adapter\Image\ImageRetriever(
                Context::getContext()->link
                ), Context::getContext()->link, new \PrestaShop\PrestaShop\Adapter\Product\PriceFormatter(), new \PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever(), Context::getContext()->getTranslator()
        );

        if ($products) {
            foreach ($products as &$product) {
                $product = $presenter->present(
                        $presentationSettings, $assembler->assembleProduct($product), Context::getContext()->language
                );
            }
        }

        $this->smarty->assign(array(
            'products' => $products,
            'link' => Context::getContext()->link,
            'static_token' => Tools::getToken(false),
            'number_load' => $numberload
        ));
        return $this->display(__FILE__, 'views/templates/front/widgets/nov-product-loadmore/filter_products.tpl');
    }

    public static function getCategories() {
        $id_language = Context::getContext()->language->id;
        return Category::getNestedCategories(null, $id_language);
    }

    public function getCategoriesBlog() {
        $id_lang = Context::getContext()->language->id;
        return BlogCategory::getNestedCategories(null, $id_lang);
    }

    function getTemplateVarProduct($product) {
        $context = Context::getContext();
        $presenterFactory = new \ProductPresenterFactory($context);
        $productSettings = $presenterFactory->getPresentationSettings();
        $extraContentFinder = new ProductExtraContentFinder();
        $objectPresenter = new ObjectPresenter();
        $product_obj = $objectPresenter->present($product);
        $product_obj['id_product'] = (int) $product->id;
        $product_obj['out_of_stock'] = (int) $product->out_of_stock;
        $product_obj['new'] = (int) $product->new;
        $product_obj['id_product_attribute'] = $this->getIdProductAttributeByGroupOrRequestOrDefault($product);
        $product_obj['minimal_quantity'] = $this->getProductMinimalQuantity($product_obj);
        $product_obj['quantity_wanted'] = $this->getRequiredQuantity($product_obj);
        $product_obj['extraContent'] = $extraContentFinder->addParams(['product' => $product])->present();
        $product_full = Product::getProductProperties($context->language->id, $product_obj, $context);

        $presenter = $presenterFactory->getPresenter();

        return $presenter->present(
            $productSettings,
            $product_full,
            $context->language
        );
    }

    function getIdProductAttributeByGroupOrRequestOrDefault($product) {
        $idProductAttribute = $this->getIdProductAttributeByGroup($product);
        if (null === $idProductAttribute) {
            $idProductAttribute = (int) Tools::getValue('id_product_attribute');
        }

        if (0 === $idProductAttribute) {
            $idProductAttribute = (int) Product::getDefaultAttribute($product->id);
        }

        return $this->tryToGetAvailableIdProductAttribute($product, $idProductAttribute);
    }

    function getIdProductAttributeByGroup($product) {
        $groups = Tools::getValue('group');
        if (empty($groups)) {
            return null;
        }

        return (int) Product::getIdProductAttributeByIdAttributes(
            $product->id,
            $groups,
            true
        );
    }

    function tryToGetAvailableIdProductAttribute($product, $checkedIdProductAttribute) {
        if (!Configuration::get('PS_DISP_UNAVAILABLE_ATTR')) {
            $productCombinations = $product->getAttributeCombinations();
            if (!Product::isAvailableWhenOutOfStock($product->out_of_stock)) {
                $availableProductAttributes = array_filter(
                    $productCombinations,
                    function ($elem) {
                        return $elem['quantity'] > 0;
                    }
                );
            } else {
                $availableProductAttributes = $productCombinations;
            }

            $availableProductAttribute = array_filter(
                $availableProductAttributes,
                function ($elem) use ($checkedIdProductAttribute) {
                    return $elem['id_product_attribute'] == $checkedIdProductAttribute;
                }
            );

            if (empty($availableProductAttribute) && count($availableProductAttributes)) {
                // if selected combination is NOT available ($availableProductAttribute) but they are other alternatives ($availableProductAttributes), then we'll try to get the closest.
                if (!Product::isAvailableWhenOutOfStock($product->out_of_stock)) {
                    // first lets get information of the selected combination.
                    $checkProductAttribute = array_filter(
                        $productCombinations,
                        function ($elem) use ($checkedIdProductAttribute) {
                            return $elem['id_product_attribute'] == $checkedIdProductAttribute || (!$checkedIdProductAttribute && $elem['default_on']);
                        }
                    );
                    if (count($checkProductAttribute)) {
                        // now lets find other combinations for the selected attributes.
                        $alternativeProductAttribute = [];
                        foreach ($checkProductAttribute as $key => $attribute) {
                            $alternativeAttribute = array_filter(
                                $availableProductAttributes,
                                function ($elem) use ($attribute) {
                                    return $elem['id_attribute'] == $attribute['id_attribute'] && !$elem['is_color_group'];
                                }
                            );
                            foreach ($alternativeAttribute as $key => $value) {
                                $alternativeProductAttribute[$key] = $value;
                            }
                        }

                        if (count($alternativeProductAttribute)) {
                            // if alternative combination is found, order the list by quantity to use the one with more stock.
                            usort($alternativeProductAttribute, function ($a, $b) {
                                if ($a['quantity'] == $b['quantity']) {
                                    return 0;
                                }

                                return ($a['quantity'] > $b['quantity']) ? -1 : 1;
                            });

                            return (int) array_shift($alternativeProductAttribute)['id_product_attribute'];
                        }
                    }
                }

                return (int) array_shift($availableProductAttributes)['id_product_attribute'];
            }
        }

        return $checkedIdProductAttribute;
    }

    function getProductMinimalQuantity($product) {
        $minimal_quantity = 1;

        if ($product['id_product_attribute']) {
            $combination = $this->findProductCombinationById($product, $product['id_product_attribute']);
            if ($combination['minimal_quantity']) {
                $minimal_quantity = $combination['minimal_quantity'];
            }
        } else {
            $minimal_quantity = $product->minimal_quantity;
        }

        return $minimal_quantity;
    }

    function findProductCombinationById($product, $combinationId) {
        $context = Context::getContext();
        $combinations = $this->getAttributesGroups($product, $context->language->id, $combinationId);

        if ($combinations === false || !is_array($combinations) || empty($combinations)) {
            return null;
        }

        return reset($combinations);
    }

    public function getAttributesGroups($product, $id_lang, $id_product_attribute = null) {
        if (!Combination::isFeatureActive()) {
            return [];
        }
        if (is_object($product)) {
            $id_product = $product->id;
        }
        else {
            $id_product = $product['id'];
        }
        $sql = 'SELECT ag.`id_attribute_group`, ag.`is_color_group`, agl.`name` AS group_name, agl.`public_name` AS public_group_name,
                    a.`id_attribute`, al.`name` AS attribute_name, a.`color` AS attribute_color, product_attribute_shop.`id_product_attribute`,
                    IFNULL(stock.quantity, 0) as quantity, product_attribute_shop.`price`, product_attribute_shop.`ecotax`, product_attribute_shop.`weight`,
                    product_attribute_shop.`default_on`, pa.`reference`, pa.`ean13`, pa.`mpn`, pa.`upc`, pa.`isbn`, product_attribute_shop.`unit_price_impact`,
                    product_attribute_shop.`minimal_quantity`, product_attribute_shop.`available_date`, ag.`group_type`
                FROM `' . _DB_PREFIX_ . 'product_attribute` pa
                ' . Shop::addSqlAssociation('product_attribute', 'pa') . '
                ' . Product::sqlStock('pa', 'pa') . '
                LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute_combination` pac ON (pac.`id_product_attribute` = pa.`id_product_attribute`)
                LEFT JOIN `' . _DB_PREFIX_ . 'attribute` a ON (a.`id_attribute` = pac.`id_attribute`)
                LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group` ag ON (ag.`id_attribute_group` = a.`id_attribute_group`)
                LEFT JOIN `' . _DB_PREFIX_ . 'attribute_lang` al ON (a.`id_attribute` = al.`id_attribute`)
                LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group_lang` agl ON (ag.`id_attribute_group` = agl.`id_attribute_group`)
                ' . Shop::addSqlAssociation('attribute', 'a') . '
                WHERE pa.`id_product` = ' . (int) $id_product . '
                    AND al.`id_lang` = ' . (int) $id_lang . '
                    AND agl.`id_lang` = ' . (int) $id_lang . '
                ';

        if ($id_product_attribute !== null) {
            $sql .= ' AND product_attribute_shop.`id_product_attribute` = ' . (int) $id_product_attribute . ' ';
        }

        $sql .= 'GROUP BY id_attribute_group, id_product_attribute
                ORDER BY ag.`position` ASC, a.`position` ASC, agl.`name` ASC';

        return Db::getInstance()->executeS($sql);
    }

    function getRequiredQuantity($product)
    {
        $requiredQuantity = (int) Tools::getValue('quantity_wanted', $this->getProductMinimalQuantity($product));
        if ($requiredQuantity < $product['minimal_quantity']) {
            $requiredQuantity = $product['minimal_quantity'];
        }

        return $requiredQuantity;
    }

    function getCombinationImages($id_product, $id_lang) {
        $product_attributes = \Db::getInstance()->executeS(
            'SELECT `id_product_attribute`
            FROM `' . _DB_PREFIX_ . 'product_attribute`
            WHERE `id_product` = ' . (int) $id_product
        );

        if (!$product_attributes) {
            return false;
        }

        $ids = [];

        foreach ($product_attributes as $product_attribute) {
            $ids[] = (int) $product_attribute['id_product_attribute'];
        }

        $result = \Db::getInstance()->executeS(
            '
            SELECT pai.`id_image`, pai.`id_product_attribute`, il.`legend`
            FROM `' . _DB_PREFIX_ . 'product_attribute_image` pai
            LEFT JOIN `' . _DB_PREFIX_ . 'image_lang` il ON (il.`id_image` = pai.`id_image`)
            LEFT JOIN `' . _DB_PREFIX_ . 'image` i ON (i.`id_image` = pai.`id_image`)
            WHERE pai.`id_product_attribute` IN (' . implode(', ', $ids) . ') AND il.`id_lang` = ' . (int) $id_lang . ' ORDER by i.`position`'
        );

        if (!$result) {
            return false;
        }

        $images = [];

        foreach ($result as $row) {
            $images[$row['id_product_attribute']][] = $row;
        }

        return $images;
    }

    public static function assignAttributesGroups($id_product, $product_for_template = null) {
        $context = Context::getContext();
        $product = new Product ($id_product, $context->language->id, $context->shop->id);
        $colors = [];
        $groups = [];
        $combinations = [];
        $nov = new NovElementor();
        $attributes_groups = $nov->getAttributesGroups($product, $context->language->id);
        if (is_array($attributes_groups) && $attributes_groups) {
            $combination_images = $nov->getCombinationImages($id_product, $context->language->id);
            $combination_prices_set = [];
            foreach ($attributes_groups as $k => $row) {
                // Color management
                if (isset($row['is_color_group']) && $row['is_color_group'] && (isset($row['attribute_color']) && $row['attribute_color']) || (file_exists(_PS_COL_IMG_DIR_ . $row['id_attribute'] . '.jpg'))) {
                    $colors[$row['id_attribute']]['value'] = $row['attribute_color'];
                    $colors[$row['id_attribute']]['name'] = $row['attribute_name'];
                    if (!isset($colors[$row['id_attribute']]['attributes_quantity'])) {
                        $colors[$row['id_attribute']]['attributes_quantity'] = 0;
                    }
                    $colors[$row['id_attribute']]['attributes_quantity'] += (int) $row['quantity'];
                }
                if (!isset($groups[$row['id_attribute_group']])) {
                    $groups[$row['id_attribute_group']] = [
                        'group_name' => $row['group_name'],
                        'name' => $row['public_group_name'],
                        'group_type' => $row['group_type'],
                        'default' => -1,
                    ];
                }

                $groups[$row['id_attribute_group']]['attributes'][$row['id_attribute']] = [
                    'name' => $row['attribute_name'],
                    'html_color_code' => $row['attribute_color'],
                    'texture' => (@filemtime(_PS_COL_IMG_DIR_ . $row['id_attribute'] . '.jpg')) ? _THEME_COL_DIR_ . $row['id_attribute'] . '.jpg' : '',
                    'selected' => (isset($product_for_template['attributes'][$row['id_attribute_group']]['id_attribute']) && $product_for_template['attributes'][$row['id_attribute_group']]['id_attribute'] == $row['id_attribute']) ? true : false,
                ];

                //$product.attributes.$id_attribute_group.id_attribute eq $id_attribute
                if ($row['default_on'] && $groups[$row['id_attribute_group']]['default'] == -1) {
                    $groups[$row['id_attribute_group']]['default'] = (int) $row['id_attribute'];
                }
                if (!isset($groups[$row['id_attribute_group']]['attributes_quantity'][$row['id_attribute']])) {
                    $groups[$row['id_attribute_group']]['attributes_quantity'][$row['id_attribute']] = 0;
                }
                $groups[$row['id_attribute_group']]['attributes_quantity'][$row['id_attribute']] += (int) $row['quantity'];
            }

            // wash attributes list depending on available attributes depending on selected preceding attributes
            $current_selected_attributes = [];
            $count = 0;
            foreach ($groups as &$group) {
                ++$count;
                if ($count > 1) {
                    //find attributes of current group, having a possible combination with current selected
                    $id_product_attributes = [0];
                    $query = 'SELECT pac.`id_product_attribute`
                        FROM `' . _DB_PREFIX_ . 'product_attribute_combination` pac
                        INNER JOIN `' . _DB_PREFIX_ . 'product_attribute` pa ON pa.id_product_attribute = pac.id_product_attribute
                        WHERE id_product = ' . $id_product . ' AND id_attribute IN (' . implode(',', array_map('intval', $current_selected_attributes)) . ')
                        GROUP BY id_product_attribute
                        HAVING COUNT(id_product) = ' . count($current_selected_attributes);
                    if ($results = \Db::getInstance()->executeS($query)) {
                        foreach ($results as $row) {
                            $id_product_attributes[] = $row['id_product_attribute'];
                        }
                    }
                    $id_attributes = \Db::getInstance()->executeS('SELECT pac2.`id_attribute` FROM `' . _DB_PREFIX_ . 'product_attribute_combination` pac2' .
                        ((!\Product::isAvailableWhenOutOfStock($product->out_of_stock) && 0 == \Configuration::get('PS_DISP_UNAVAILABLE_ATTR')) ?
                            ' INNER JOIN `' . _DB_PREFIX_ . 'stock_available` pa ON pa.id_product_attribute = pac2.id_product_attribute
                        WHERE pa.quantity > 0 AND ' :
                            ' WHERE ') .
                        'pac2.`id_product_attribute` IN (' . implode(',', array_map('intval', $id_product_attributes)) . ')
                        AND pac2.id_attribute NOT IN (' . implode(',', array_map('intval', $current_selected_attributes)) . ')');
                    foreach ($id_attributes as $k => $row) {
                        $id_attributes[$k] = (int) $row['id_attribute'];
                    }
                    foreach ($group['attributes'] as $key => $attribute) {
                        if (!in_array((int) $key, $id_attributes)) {
                            unset(
                                $group['attributes'][$key],
                                $group['attributes_quantity'][$key]
                            );
                        }
                    }
                }
                //find selected attribute or first of group
                $index = 0;
                $current_selected_attribute = 0;
                foreach ($group['attributes'] as $key => $attribute) {
                    if ($index === 0) {
                        $current_selected_attribute = $key;
                    }
                    if ($attribute['selected']) {
                        $current_selected_attribute = $key;

                        break;
                    }
                }
                if ($current_selected_attribute > 0) {
                    $current_selected_attributes[] = $current_selected_attribute;
                }
            }

            // wash attributes list (if some attributes are unavailables and if allowed to wash it)
            if (!\Product::isAvailableWhenOutOfStock($product->out_of_stock) && \Configuration::get('PS_DISP_UNAVAILABLE_ATTR') == 0) {
                foreach ($groups as &$group) {
                    foreach ($group['attributes_quantity'] as $key => $quantity) {
                        if ($quantity <= 0) {
                            unset($group['attributes'][$key]);
                        }
                    }
                }

                foreach ($colors as $key => $color) {
                    if ($color['attributes_quantity'] <= 0) {
                        unset($colors[$key]);
                    }
                }
            }
            unset($group);
        }
        else {
            $groups = array();
            $colors = array();
            $combination_images = array();
        }

        return [
            'groups' => $groups,
            'colors' => (count($colors)) ? $colors : false,
            'combinationImages' => $combination_images
        ];
    }
}
