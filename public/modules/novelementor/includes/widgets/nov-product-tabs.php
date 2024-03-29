<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovProductTabs extends WidgetBase {

    public function getName() {
        return 'nov-product-tabs';
    }

    public function getTitle() {
        return __('Nov Product Tabs', 'elementor');
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
                'section_producttabs_settings', array(
            'label' => __('Nov Product Tabs Settings', 'elementor'),
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
            'default' => ''
                )
        );
        $this->addControl(
                'tabs_show', array(
            'label' => __('Select Tabs show', 'elementor'),
            'type' => ControlsManager::SELECT2,
            'multiple' => true,
            'options' => array(
                'newproducts' => __('New Products', 'elementor'),
                'bestsellers' => __('BestSeller Products', 'elementor'),
                'specialproducts' => __('Special Products', 'elementor'),
                'featureproducts' => __('Feature Products', 'elementor'),
            )
                )
        );

        $this->addControl(
                'tabs_style', array(
            'label' => __('Tab Style', 'elementor'),
            'type' => ControlsManager::SELECT2,
            'default' => '1',
            'options' => array(
                '1' => __('Style 1', 'elementor'),
                '2' => __('Style 2', 'elementor'),
            )
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
            )
                )
        );

        $this->addControl(
                'style_6', array(
            'label' => __('Style Slider Type 6', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => '1',
            'options' => array(
                '1' => __('Stype 1 ', 'elementor'),
                '2' => __('Stype 2', 'elementor'),
            ),
            'condition' => array(
                'display_type' => array('slider-type-6'),
            ),
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
                'display_type' => array('slider-type', 'slider-type-1', 'slider-type-2', 'slider-type-3', 'slider-type-4', 'slider-type-5', 'slider-type-6', 'slider-type-7', 'slider-type-8', 'slider-type-9', 'slider-type-list'),
            ),
                )
        );
        $this->addControl(
                'number_row_mobile', array(
            'label' => __('Number Row Mobile', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => '2',
            'options' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3'
            ),
            'condition' => array(
                'number_row' => array('1'),
            ),
                )
        );
        $this->addControl(
                'show_arrows', array(
            'label' => __('Show Arrows', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
            'condition' => array(
                'display_type' => array('slider-type', 'slider-type-1', 'slider-type-2', 'slider-type-3', 'slider-type-4', 'slider-type-5', 'slider-type-6', 'slider-type-7', 'slider-type-8', 'slider-type-9', 'slider-type-list'),
            ),
                )
        );

        $this->addControl(
                'show_dots', array(
            'label' => __('Show Dots', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
            'condition' => array(
                'display_type' => array('slider-type', 'slider-type-1', 'slider-type-2', 'slider-type-3', 'slider-type-4', 'slider-type-5', 'slider-type-6', 'slider-type-7', 'slider-type-8', 'slider-type-9', 'slider-type-list'),
            ),
                )
        );

        $this->addControl(
                'autoplay', array(
            'label' => __('Autoplay', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
            'condition' => array(
                'display_type' => array('slider-type', 'slider-type-1', 'slider-type-2', 'slider-type-3', 'slider-type-4', 'slider-type-5', 'slider-type-6', 'slider-type-7', 'slider-type-8', 'slider-type-9', 'slider-type-list'),
            ),
                )
        );
        $this->addControl(
                'autoplayspeed', array(
            'label' => __('Autoplay Speed', 'elementor'),
            'type' => ControlsManager::NUMBER,
            'default' => 0,
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

    protected function render() {
        $settings = $this->getSettings();
        $column = \NovElementor::get_classnumbercolumn($settings['columns'], $settings['columns_tablet'], $settings['columns_mobile'], $settings['number_row'], $settings['number_row_mobile']);
        $novconfig = \NovElementor::getConfigTheme();
        $tabs = $settings['tabs_show'];

        $catids = $settings['id_categorys'];

        $filter = '';
        if (!empty($catids) && is_array($catids)) {
            $filter = 'cp.`id_category` IN (' . implode(',', $catids) . ')';
        } else {
            $filter = 'cp.`id_category` IN (2)';
        }

        $cache_products = \NovElementor::NovgetProducts($filter, (int) $this->context->language->id, 0, $settings['limit'], false);
        $assembler = new \ProductAssembler($this->context);
        $presenterFactory = new \ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = new \PrestaShop\PrestaShop\Core\Product\ProductListingPresenter(
                new \PrestaShop\PrestaShop\Adapter\Image\ImageRetriever(
                $this->context->link
                ), $this->context->link, new \PrestaShop\PrestaShop\Adapter\Product\PriceFormatter(), new \PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever(), $this->context->getTranslator()
        );

        $newproducts = [];
        if (isset($cache_products) && $cache_products) {
            foreach ($cache_products as $rawProduct) {
                $newproducts[] = $presenter->present(
                        $presentationSettings, $assembler->assembleProduct($rawProduct), $this->context->language
                );
            }
        }
        $groups1 = [];
        if (isset($cache_products) && $cache_products) {
            foreach ($cache_products as $key => $rawProduct) {
                $groups1[$rawProduct['id_product']] = \NovElementor::assignAttributesGroups($rawProduct['id_product'], $newproducts[$key]);
            }
        }

        $bestsellersproducts = [];
        $bestseller = \NovElementor::getBestSales($filter, (int) $this->context->language->id, 0, $settings['limit'], 'date_add', $settings['orderway']);
        if (isset($bestseller) && $bestseller) {
            foreach ($bestseller as &$product) {
                $bestsellersproducts[] = $presenter->present(
                        $presentationSettings, $assembler->assembleProduct($product), $this->context->language
                );
            }
        }
        $groups2 = [];
        if (isset($bestseller) && $bestseller) {
            foreach ($bestsellersproducts as $key => $rawProduct) {
                $groups2[$rawProduct['id_product']] = \NovElementor::assignAttributesGroups($rawProduct['id_product'], $bestsellersproducts[$key]);
            }
        }

        $specialproducts = [];
        $special = \NovElementor::getPricesDrop($filter, (int) $this->context->language->id, 0, $settings['limit'], false, $settings['orderby'], $settings['orderway']);
        if (isset($special) && $special) {
            foreach ($special as &$product) {
                $specialproducts[] = $presenter->present(
                        $presentationSettings, $assembler->assembleProduct($product), $this->context->language
                );
            }
        }
        $groups3 = [];
        if (isset($special) && $special) {
            foreach ($special as $key => $rawProduct) {
                $groups3[$rawProduct['id_product']] = \NovElementor::assignAttributesGroups($rawProduct['id_product'], $specialproducts[$key]);
            }
        }

        $featureproducts = [];
        $category = new \Category($this->context->shop->getCategory(), (int) $this->context->language->id);
        $featured = $category->getProducts((int) $this->context->language->id, 0, $settings['limit'], $settings['orderby'], $settings['orderway']);
        if (isset($featured) && $featured) {
            foreach ($featured as $product) {
                $featureproducts[] = $presenter->present(
                        $presentationSettings, $assembler->assembleProduct($product), $this->context->language
                );
            }
        }
        $groups4 = [];
        if (isset($featured) && $featured) {
            foreach ($featured as $key => $rawProduct) {
                $groups4[$rawProduct['id_product']] = \NovElementor::assignAttributesGroups($rawProduct['id_product'], $featureproducts[$key]);
            }
        }

        $show_arrows = ($settings['show_arrows'] == 'on') ? 'true' : 'false';
        $show_dots = ($settings['show_dots'] == 'on') ? 'true' : 'false';
        $autoplay = ($settings['autoplay'] == 'on') ? 'true' : 'false';

        $this->context->smarty->assign('settings', $settings);
        $this->context->smarty->assign('groups1', $groups1);
        $this->context->smarty->assign('groups2', $groups2);
        $this->context->smarty->assign('groups3', $groups3);
        $this->context->smarty->assign('groups4', $groups4);
        $this->context->smarty->assign('nov_dir', _PS_THEME_DIR_);
        $this->context->smarty->assign('tab', rand());
        $this->context->smarty->assign('tabs', $tabs);
        $this->context->smarty->assign('novconfig', $novconfig);
        $this->context->smarty->assign('column', $column);
        $this->context->smarty->assign('style_6', $settings['style_6']);
        $this->context->smarty->assign('newproducts', $newproducts);
        $this->context->smarty->assign('bestsellersproducts', $bestsellersproducts);
        $this->context->smarty->assign('specialproducts', $specialproducts);
        $this->context->smarty->assign('featureproducts', $featureproducts);
        $this->context->smarty->assign('tabs_style', $settings['tabs_style']);
        $this->context->smarty->assign('title', $settings['title']);
        $this->context->smarty->assign('sub_title', $settings['sub_title']);
        $this->context->smarty->assign('lg', $settings['columns']);
        $this->context->smarty->assign('md', $settings['columns_tablet']);
        $this->context->smarty->assign('xs', $settings['columns_mobile']);
        $this->context->smarty->assign('number_row', $settings['number_row']);
        $this->context->smarty->assign('number_row_mobile', $settings['number_row_mobile']);
        $this->context->smarty->assign('show_arrows', $show_arrows);
        $this->context->smarty->assign('show_dots', $show_dots);
        $this->context->smarty->assign('autoplay', $autoplay);
        $this->context->smarty->assign('autoplayspeed', $settings['autoplayspeed']);
        $this->context->smarty->assign('spacing', $settings['spacing']);
        $this->context->smarty->assign('el_class', '');

        $tpl = "module:novelementor/views/templates/front/widgets/nov-product-tabs/{$settings['display_type']}.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
