<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovSingleProduct extends WidgetBase
{
    public function getName()
    {
        return 'nov-single-product';
    }

    public function getTitle()
    {
        return __('Nov Single Product', 'elementor');
    }

    public function getIcon()
    {
        return 'vinova-icon';
    }

    public function getCategories()
    {
        return array('vinova');
    }

    protected function _registerControls()
    {
        $this->startControlsSection(
            'section_single_product_settings',
            array(
                'label' => __('Nov Single Product Settings', 'elementor'),
            )
        );

        $this->addControl(
            'title',
            array(
                'label' => __('Title', 'elementor'),
                'type' => ControlsManager::TEXT,
                'default' => ''
            )
        );

        $this->addControl(
            'sub_title',
            array(
                'label' => __('Sub Title', 'elementor'),
                'type' => ControlsManager::TEXT,
                'default' => ''
            )
        );

        $this->addControl(
            'title_align',
            array(
                'label' => __('Title Align', 'elementor'),
                'type' => ControlsManager::SELECT,
                'default' => 'left',
                'options' => array(
                    'left' => __('Left', 'elementor'),
                    'center' => __('Center', 'elementor'),
                    'right' => __('Right', 'elementor')
                )
            )
        );

        $this->addControl(
            'id_product',
            array(
                'label' => __('Product ID', 'elementor'),
                'type' => ControlsManager::NUMBER,
                'default' => ''
            )
        );

        $this->addControl(
            'display_type',
            array(
                'label' => __('Display Style', 'elementor'),
                'type' => ControlsManager::SELECT,
                'default' => 'style-1',
                'options' => array(
                    'style-1' => __('Style 1', 'elementor'),
                    'style-2' => __('Style 2', 'elementor')
                )
            )
        );

        $this->endControlsSection();
    }

    public function getControls($control_id = null)
    {
        $controls = parent::getControls($control_id);

        if (_THEME_NAME_ == 'classic') {
            if (isset($controls['_margin'])) {
                $controls['_margin']['default'] = array(
                    'top' => '0',
                    'right' => '-10',
                    'bottom' => '0',
                    'left' => '-10',
                    'unit' => 'px',
                    'isLinked' => false,
                );
            }

            if (isset($controls['_css_classes'])) {
                $controls['_css_classes']['default'] = '';
            }
        }

        return $controls;
    }

    protected function getSelectedProducts($id_products, $order_by = null, $order_way = null)
    {
        $context = \Context::getContext();
        $id_lang = $context->language->id;
        $front = true;
        if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
            $front = false;


        $str = $id_products;

        if ($order_by == 'id_product' || $order_by == 'price' || $order_by == 'date_add' || $order_by == 'date_upd')
            $order_by_prefix = 'p';
        elseif ($order_by == 'name')
            $order_by_prefix = 'pl';


        $sql = 'SELECT p.*, product_shop.*, pl.*, image_shop.`id_image`, il.`legend`, m.`name` AS manufacturer_name, s.`name` AS supplier_name
				FROM `' . _DB_PREFIX_ . 'product` p
				' . \Shop::addSqlAssociation('product', 'p') . '
				LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (p.`id_product` = pl.`id_product` ' . \Shop::addSqlRestrictionOnLang('pl') . ')
				LEFT JOIN `' . _DB_PREFIX_ . 'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
				LEFT JOIN `' . _DB_PREFIX_ . 'supplier` s ON (s.`id_supplier` = p.`id_supplier`)
                                LEFT JOIN `' . _DB_PREFIX_ . 'image` i ON (i.`id_product` = p.`id_product`)' .
            \Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1') . '
				LEFT JOIN `' . _DB_PREFIX_ . 'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = ' . (int) $context->language->id . ')
				WHERE pl.`id_lang` = ' . (int) $id_lang .
            ' AND p.`id_product` IN( ' . $str . ')' .
            ($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '') .
            ' AND ((image_shop.id_image IS NOT NULL OR i.id_image IS NULL) OR (image_shop.id_image IS NULL AND i.cover=1))' .
            ' AND product_shop.`active` = 1';

        if (!empty($order_by) && isset($order_by_prefix)) {
            $sql .= " ORDER BY {$order_by_prefix}.{$order_by} {$order_way}";
        }


        $rq = \Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        if (!$rq)
            return array();

        return \Product::getProductsProperties($id_lang, $rq);
    }

    protected function render()
    {
        $context = \Context::getContext();
        $settings = $this->getSettings();

        if(empty($settings['id_product'])) return ;

        $product = $this->getSelectedProducts($settings['id_product']);
        if(!$product){
            return false;
        }

        $assembler = new \ProductAssembler($context);
        $presenterFactory = new \ProductPresenterFactory($context);
        $presentationSettings = $presenterFactory->getPresentationSettings();

        $presenter = new \PrestaShop\PrestaShop\Core\Product\ProductListingPresenter(
            new \PrestaShop\PrestaShop\Adapter\Image\ImageRetriever(
                $context->link
            ),
            $context->link,
            new \PrestaShop\PrestaShop\Adapter\Product\PriceFormatter(),
            new \PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever(),
            $context->getTranslator()
        );

        $products_for_template = [];

        foreach ($product as $rawProduct) {
            $products_for_template[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct($rawProduct),
                $context->language
            );
        }

        $groups = [];
        foreach ($product as $key => $rawProduct) {
            $groups[$rawProduct['id_product']] = \NovElementor::assignAttributesGroups($rawProduct['id_product'], $products_for_template[$key]);
        }

        $this->context->smarty->assign('settings', $settings);
        $this->context->smarty->assign('products', $products_for_template);
        $this->context->smarty->assign('groups', $groups);
        $this->context->smarty->assign('link', $context->link);
        $this->context->smarty->assign('static_token', \Tools::getToken(false));

        $tpl = "module:novelementor/views/templates/front/widgets/nov-single-product/{$settings['display_type']}.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate()
    {
    }

    public function __construct($data = array(), $args = array())
    {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }
}
