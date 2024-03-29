<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovProductList2 extends WidgetBase {

    public function getName() {
        return 'nov-product-list-2';
    }

    public function getTitle() {
        return __('Nov Product List 2', 'elementor');
    }

    public function getIcon() {
        return 'vinova-icon';
    }

    public function getCategories() {
        return array('vinova');
    }

    protected function getAllCategories() {
        $opts = array();

        $array_cats = \NovElementor::getCategories();
        if ($array_cats) {
            foreach ($array_cats as $root) {
                $opts[$root['id_category']] = $root['name'];
                foreach ($root['children'] as $cat) {
                    $opts[' ' . $cat['id_category']] = $cat['name'];
                    if (!empty($cat['children'])) {
                        foreach ($cat['children'] as $cat2) {
                            $opts[' ' . $cat2['id_category']] = '&nbsp;' . $cat2['name'];
                            if (!empty($cat2['children'])) {
                                foreach ($cat2['children'] as $cat3) {
                                    $opts[' ' . $cat3['id_category']] = '&nbsp;&nbsp;' . $cat3['name'];
                                    if (!empty($cat3['children'])) {
                                        foreach ($cat3['children'] as $cat4) {
                                            $opts[' ' . $cat4['id_category']] = '&nbsp;&nbsp;&nbsp;' . $cat4['name'];
                                            if (!empty($cat4['children'])) {
                                                foreach ($cat4['children'] as $cat5) {
                                                    $opts[' ' . $cat5['id_category']] = '&nbsp;&nbsp;&nbsp;&nbsp;' . $cat5['name'];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $opts;
    }

    protected function _registerControls() {
        $this->startControlsSection(
                'section_productlist2_settings', array(
            'label' => __('Nov Product List Settings', 'elementor'),
                )
        );

        $this->addControl(
                'title', array(
            'label' => __('Title', 'elementor'),
            'type' => ControlsManager::TEXT,
            'default' => ''
                )
        );
        $this->addControl(
                'sub_title', array(
            'label' => __('Sub Title', 'elementor'),
            'type' => ControlsManager::TEXT,
            'default' => '',
            'condition' => array(
                'display_type' => array('slider-type-1'),
            ),
                )
        );
        $this->addControl(
                'view_all', array(
            'label' => __('View All', 'elementor'),
            'type' => ControlsManager::TEXT,
            'default' => '',
            'condition' => array(
                'display_type' => array('slider-type-1'),
            ),
                )
        );
        $this->addControl(
                'link', array(
            'label' => __('Link View All', 'elementor'),
            'type' => ControlsManager::URL,
            'placeholder' => 'http://your-link.com',
            'default' => array(
                'url' => '#',
            ),
            'condition' => array(
                'display_type' => array('slider-type-1'),
            ),
                )
        );
        $this->addControl(
                'id_categorys', array(
            'label' => __('Select Category', 'elementor'),
            'type' => ControlsManager::SELECT2,
            'multiple' => true,
            'options' => $this->getAllCategories()
                )
        );
        $this->addControl(
                'type_product', array(
            'label' => __('Product Type', 'elementor'),
            'type' => ControlsManager::SELECT2,
            'default' => 'new',
            'options' => array(
                'new' => 'New',
                'bestseller' => 'Best Seller',
                'special' => 'Special',
                'feature' => 'Feature',
            ),
                )
        );
        $this->addControl(
                'limit', array(
            'label' => __('Limit', 'elementor'),
            'type' => ControlsManager::NUMBER,
            'default' => 12
                )
        );

        $this->addControl(
                'orderby', array(
            'label' => __('Order By', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'id_product',
            'options' => array(
                'id_product' => __('Popularity', 'elementor'),
                'price' => __('Product Price', 'elementor'),
                'date_add' => __('Arrival', 'elementor'),
                'date_upd' => __('Update', 'elementor'),
                'name' => __('Product Name', 'elementor'),
            )
                )
        );

        $this->addControl(
                'orderway', array(
            'label' => __('Order Direction', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'DESC',
            'options' => array(
                'ASC' => __('Ascending', 'elementor'),
                'DESC' => __('Descending', 'elementor'),
            )
                )
        );

        $this->addControl(
                'display_type', array(
            'label' => __('Display Style', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'slider-type-1',
            'options' => array(
                'slider-type-1' => __('Slider Stype 1', 'elementor'),
                'slider-type-2' => __('Slider Stype 2', 'elementor'),
                'slider-type-3' => __('Slider Stype 3', 'elementor')
            )
                )
        );
        $this->addControl(
                'number_row', array(
            'label' => __('Number Row', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => '1',
            'options' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3'
            ),
            'condition' => array(
                'display_type' => array('slider-type-1', 'slider-type-2', 'slider-list', 'slider-list-2', 'slider-type-3', 'slider-type-4', 'slider-type-5'),
            ),
                )
        );

        $this->addControl(
                'show_arrows', array(
            'label' => __('Show Arrows', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
            'condition' => array(
                'display_type' => array('slider-type-1', 'slider-type-2', 'slider-list', 'slider-list-2', 'slider-type-3', 'slider-type-4', 'slider-type-5'),
            ),
                )
        );

        $this->addControl(
                'show_dots', array(
            'label' => __('Show Dots', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
            'condition' => array(
                'display_type' => array('slider-type-1', 'slider-type-2', 'slider-list', 'slider-list-2', 'slider-type-3', 'slider-type-4', 'slider-type-5'),
            ),
                )
        );

        $this->addControl(
                'autoplay', array(
            'label' => __('Autoplay', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
            'condition' => array(
                'display_type' => array('slider-type-1', 'slider-type-2', 'slider-list', 'slider-list-2', 'slider-type-3', 'slider-type-4', 'slider-type-5'),
            ),
                )
        );

        $this->addControl(
                'spacing', array(
            'label' => __('Spacing Product', 'elementor'),
            'type' => ControlsManager::NUMBER,
            'default' => 0,
                )
        );

        $this->addResponsiveControl(
                'columns', array(
            'label' => __('Columns', 'elementor'),
            'type' => ControlsManager::NUMBER,
            'min' => 1,
            'selectors' => array(
                '{{WRAPPER}} .elementor-product-grid > *' => implode(';', array(
                    '-ms-flex-preferred-size: calc(100% / {{VALUE}})',
                    '-webkit-flex-basis: calc(100% / {{VALUE}})',
                    'flex-basis: calc(100% / {{VALUE}})',
                    'max-width: calc(100% / {{VALUE}})',
                )),
            ),
            'default' => 4,
            'tablet_default' => 3,
            'mobile_default' => 1,
                )
        );

        $this->endControlsSection();
    }

    public function getControls($control_id = null) {
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

    protected function getProducts($listing, $orderBy, $orderDir, $limit, $categoryId = 2) {
        $query = new \PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery();
        $query->setResultsPerPage($limit <= 0 ? 8 : (int) $limit);
        $query->setQueryType($listing);

        switch ($listing) {
            case 'category':
                $category = new \Category((int) $categoryId);
                $searchProvider = new \PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider($this->context->getTranslator(), $category);
                $query->setQueryType($listing);
                $query->setSortOrder(
                        'rand' == $orderBy ? \PrestaShop\PrestaShop\Core\Product\Search\SortOrder::random() : new \PrestaShop\PrestaShop\Core\Product\Search\SortOrder('product', $orderBy, $orderDir)
                );
                break;
            case 'prices-drop':
                $searchProvider = new \PrestaShop\PrestaShop\Adapter\PricesDrop\PricesDropProductSearchProvider($this->context->getTranslator());
                $query->setQueryType($listing);
                $query->setSortOrder(new \PrestaShop\PrestaShop\Core\Product\Search\SortOrder('product', $orderBy, $orderDir));
                break;
            case 'new-products':
                $searchProvider = new \PrestaShop\PrestaShop\Adapter\NewProducts\NewProductsProductSearchProvider($this->context->getTranslator());
                $query->setSortOrder(new \PrestaShop\PrestaShop\Core\Product\Search\SortOrder('product', 'date_add', 'desc'));
                break;
            case 'best-sales':
                $searchProvider = new \PrestaShop\PrestaShop\Adapter\BestSales\BestSalesProductSearchProvider($this->context->getTranslator());
                $query->setSortOrder(new \PrestaShop\PrestaShop\Core\Product\Search\SortOrder('product', 'name', 'asc'));
                break;
        }

        $result = $searchProvider->runQuery(new \PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext($this->context), $query);

        $assembler = new \ProductAssembler($this->context);
        $presenterFactory = new \ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = new \PrestaShop\PrestaShop\Core\Product\ProductListingPresenter(
                new \PrestaShop\PrestaShop\Adapter\Image\ImageRetriever($this->context->link), $this->context->link, new \PrestaShop\PrestaShop\Adapter\Product\PriceFormatter(), new \PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever(), $this->context->getTranslator()
        );

        $products_for_template = array();

        foreach ($result->getProducts() as $rawProduct) {
            $products_for_template[] = $presenter->present(
                    $presentationSettings, $assembler->assembleProduct($rawProduct), $this->context->language
            );
        }
        return $products_for_template;
    }

    protected function getProducts16($listing, $orderBy, $orderDir, $limit, $categoryId = 2) {
        if (\Configuration::get('PS_CATALOG_MODE')) {
            return false;
        }
        $lang_id = (int) $this->context->language->id;

        switch ($listing) {
            case 'category':
                $category = new \Category($categoryId, $lang_id);
                if ('rand' == $orderBy) {
                    $result = $category->getProducts($lang_id, 0, $limit, null, null, false, true, true, $limit);
                } else {
                    $result = $category->getProducts($lang_id, 0, $limit, $orderBy, $orderDir);
                }
                break;
            case 'prices-drop':
                $result = \Product::getPricesDrop($lang_id, 0, (int) $limit, false, $orderBy, $orderDir);
                break;
            case 'new-products':
                $result = \Product::getNewProducts($lang_id, 0, (int) $limit);
                break;
            case 'best-sales':
                $result = \ProductSale::getBestSales($lang_id, 0, (int) $limit);
                break;
        }

        if (empty($result)) {
            return false;
        }

        $currency = new \Currency($this->context->cookie->id_currency);
        $usetax = \Product::getTaxCalculationMethod((int) $this->context->customer->id) != PS_TAX_EXC;
        foreach ($result as &$row) {
            $row['price'] = \Tools::displayPrice(\Product::getPriceStatic((int) $row['id_product'], $usetax), $currency);
        }

        return $result;
    }

    protected function render() {
        $settings = $this->getSettings();
        $catids = $settings['id_categorys'];

        $filter = '';
        if (!empty($catids) && is_array($catids)) {
            $filter = 'cp.`id_category` IN (' . implode(',', $catids) . ')';
        } else {
            $filter = 'cp.`id_category` IN (2)';
        }
        $context = \Context::getContext();

        switch ($settings['type_product']) {
            case 'new':
                // $cache_products = \NovElementor::getNewProducts($this->context->language->id, 0, 0, $settings['limit']);
                // $cache_products = \NovElementor::getNewProducts($filter, $this->context->language->id, 0, $settings['limit']);
                $cache_products = \NovElementor::getNewProducts(' AND ' . $filter, $this->context->language->id, 0, $settings['limit']);
                // $cache_products = \Product::getNewProducts($this->context->language->id, 0, (int) $settings['limit']);
                break;
            case 'bestseller':
                $cache_products = \NovElementor::getBestSales($filter, $this->context->language->id, 0, $settings['limit']);
                break;
            case 'special':
                $cache_products = \NovElementor::getPricesDrop($filter, (int) $this->context->language->id, 0, $settings['limit'], false, $settings['orderby'], $settings['orderway']);
                break;
            case 'feature':
                $category = new \Category($this->context->shop->getCategory(), (int) $this->context->language->id);
                $cache_products = $category->getProducts((int) $this->context->language->id, 0, $settings['limit'], $settings['orderby'], $settings['orderway']);
                break;
        }
        if (!$cache_products) {
            return false;
        }
        $assembler = new \ProductAssembler($context);

        $presenterFactory = new \ProductPresenterFactory($context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = new \PrestaShop\PrestaShop\Core\Product\ProductListingPresenter(
                new \PrestaShop\PrestaShop\Adapter\Image\ImageRetriever(
                $context->link
                ), $context->link, new \PrestaShop\PrestaShop\Adapter\Product\PriceFormatter(), new \PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever(), $context->getTranslator()
        );

        $products_for_template = [];

        foreach ($cache_products as $rawProduct) {
            $products_for_template[] = $presenter->present(
                    $presentationSettings, $assembler->assembleProduct($rawProduct), $context->language
            );
        }

        $groups = [];
        foreach ($cache_products as $key => $rawProduct) {
            $groups[$rawProduct['id_product']] = \NovElementor::assignAttributesGroups($rawProduct['id_product'], $products_for_template[$key]);
        }

        $show_arrows = ($settings['show_arrows'] == 'on') ? 'true' : 'false';
        $show_dots = ($settings['show_dots'] == 'on') ? 'true' : 'false';
        $autoplay = ($settings['autoplay'] == 'on') ? 'true' : 'false';
        $column = \NovElementor::get_classnumbercolumn($settings['columns'], $settings['columns'], $settings['columns_tablet'], $settings['number_row']);
        $novconfig = \NovElementor::getConfigTheme();
        $context->smarty->assign(
                array(
                    'products' => $products_for_template,
                    'groups' => $groups,
                    'title' => $settings['title'],
                    'sub_title' => $settings['sub_title'],
                    'view_all' => $settings['view_all'],
                    'nov_dir' => _PS_THEME_DIR_,
                    'spacing' => $settings['spacing'],
                    'xl' => $settings['columns'],
                    'lg' => $settings['columns'],
                    'md' => $settings['columns_tablet'],
                    'xs' => $settings['columns_mobile'],
                    'column' => $column,
                    'number_row' => $settings['number_row'],
                    'show_arrows' => $show_arrows,
                    'show_dots' => $show_dots,
                    'autoplay' => $autoplay,
                    'el_class' => '',
                    'novconfig' => $novconfig,
                    'class_item' => '123'
                )
        );
        $this->context->smarty->assign('settings', $settings);
        $tpl = "module:novelementor/views/templates/front/widgets/nov-product-list-2/{$settings['display_type']}.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
