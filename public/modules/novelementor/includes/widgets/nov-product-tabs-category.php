<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovProductTabsCategory extends WidgetBase {

    public function getName() {
        return 'nov-product-tabs-category';
    }

    public function getTitle() {
        return __('Nov Product Tabs Category', 'elementor');
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
                'section_producttabscategory_settings', array(
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
                'class', array(
            'label' => __('Class', 'elementor'),
            'type' => ControlsManager::TEXT,
            'default' => ''
                )
        );
        $this->addControl(
                'button', array(
            'name' => "button",
            'label' => __('Button', 'elementor'),
            'type' => ControlsManager::TEXT,
            'label_block' => true,
            'default' => ''
                )
        );
        $this->addControl(
                'link_buttom', array(
            'label' => __('Link buttom', 'elementor'),
            'type' => ControlsManager::URL,
            'placeholder' => 'http://your-link.com',
            'default' => array(
                'url' => '#',
            ),
                )
        );
        $this->addControl(
                'display_type', array(
            'label' => __('Display Style', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'slider-type-1',
            'options' => array(
                'slider-type-1' => __('Slider Stype 1', 'elementor'),
                'slider-type-2' => __('Slider Stype 2', 'elementor')
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
                'type_product', array(
            'label' => __('Product Type', 'elementor'),
            'type' => ControlsManager::SELECT2,
            'default' => 'new',
            'options' => array(
                'new' => 'New',
                'bestseller' => 'Best Seller',
                'special' => 'Special',
                'featured' => 'Featured',
                'toprating' => 'Products Top Rating',
                'mostview' => 'Products Most View'
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
            'default' => 'date_add',
            'options' => array(
                'date_add' => __('Date Add', 'elementor'),
                'date_upd' => __('Date Update', 'elementor'),
                'name' => __('Name', 'elementor'),
                'id_product' => __('Product Id', 'elementor'),
                'price' => __('Price', 'elementor')
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
                'number_row', array(
            'label' => __('Number Row', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => '1',
            'options' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3'
            )
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
                )
        );

        $this->addControl(
                'show_dots', array(
            'label' => __('Show Dots', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
                )
        );

        $this->addControl(
                'autoplay', array(
            'label' => __('Autoplay', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
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

        $slides_to_show = range(1, 12);
        $slides_to_show = array_combine($slides_to_show, $slides_to_show);

        $this->addResponsiveControl(
                'columns', array(
            'label' => __('Slides to Show', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 4,
            'options' => array('4' => __('4', 'elementor')) + $slides_to_show,
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
        $column = \NovElementor::get_classnumbercolumn($settings['columns'], $settings['columns_tablet'], $settings['columns_mobile'], $settings['number_row']);
        $novconfig = \NovElementor::getConfigTheme();

        $id_categorys = $settings['id_categorys'];
        $id_language = \Context::getContext()->language->id;
        $data['categories'] = array();
        if (!empty($id_categorys)) {
            $catalls = implode(",", $id_categorys);
            $filter_all = ' AND cp.`id_category` IN  (' . pSQL($catalls) . ')';

            foreach ($id_categorys as $id_category) {
                $category = new \Category((int) $id_category, \Context::getContext()->language->id);
                $filter = ' AND cp.id_category =  ' . (int) ($id_category) . '';
                $category_products = '';
                switch ($settings['type_product']) {
                    case 'new':
                        $category_products = \NovElementor::getNewProducts($filter, $this->context->language->id, 0, $settings['limit']);
                        // $category_products = \NovElementor::getNewProducts($filter, $id_language, 0, $settings['limit'], false, $settings['orderby'], $settings['orderway']);
                        break;
                    case 'featured':
                        $category = new \Category(\Context::getContext()->shop->getCategory(), $id_language);
                        $id = $category->id_category;
                        $cat = array($id, $id_category);
                        $cat = implode(",", $cat);
                        $filter = ' AND  cp.`id_category` IN  (' . pSQL($cat) . ')';
                        $category_products = $products = \NovElementor::getSpecialProducts($filter, 0, 1, $settings['limit']);
                        break;
                    case 'bestseller':
                        $category_products = \NovElementor::getBestSales($filter, (int) $id_language, 0, $settings['limit'], $settings['orderby'], $settings['orderway']);
                        break;
                    case 'special':
                        $category_products = \NovElementor::getPricesDrop($filter, (int) $id_language, 0, $settings['limit'], false, $settings['orderby'], $settings['orderway']);
                        break;
                    case 'toprating':
                        $category_products = \NovElementor::getSpecialProducts($filter, 0, 1, $settings['limit']);
                        break;
                    case 'mostview':
                        $category_products = \NovElementor::getSpecialProducts($filter, 0, 1, $settings['limit'], true, null, 'mostview');
                        break;
                }
                $assembler = new \ProductAssembler(\Context::getContext());
                $presenterFactory = new \ProductPresenterFactory(\Context::getContext());
                $presentationSettings = $presenterFactory->getPresentationSettings();
                $presenter = new \PrestaShop\PrestaShop\Core\Product\ProductListingPresenter(
                        new \PrestaShop\PrestaShop\Adapter\Image\ImageRetriever(
                        $this->context->link
                        ), $this->context->link, new \PrestaShop\PrestaShop\Adapter\Product\PriceFormatter(), new \PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever(), $this->context->getTranslator()
                );

                $products_for_template = array();
                if ($category_products) {
                    foreach ($category_products as &$product) {
                        $products_for_template[] = $presenter->present(
                            $presentationSettings,
                            $assembler->assembleProduct($product),
                            $this->context->language
                        );
                        $product = $presenter->present(
                            $presentationSettings,
                            $assembler->assembleProduct($product),
                            $this->context->language
                        );
                    }
                }

                $groups = [];
                if ($category_products) {
                    foreach ($category_products as $key => $rawProduct) {
                        $groups[$rawProduct['id_product']] = \NovElementor::assignAttributesGroups($rawProduct['id_product'], $products_for_template[$key]);
                    }
                }

                $data['categories'][$category->id_category]['name'] = $category->name;
                $data['categories'][$category->id_category]['products'] = $category_products;
                $data['categories'][$category->id_category]['groups'] = $groups;
                $files = scandir(_PS_CAT_IMG_DIR_);

                if (count(preg_grep('/^' . $id_category . '-([0-9])?_thumb.jpg/i', $files)) > 0) {
                    foreach ($files as $file) {
                        if (preg_match('/^' . $id_category . '-([0-9])?_thumb.jpg/i', $file) === 1) {
                            $image_url = \Context::getContext()->link->getMediaLink(_THEME_CAT_DIR_ . $file);
                            $data['categories'][$category->id_category]['image_urls']['value'] = $image_url;
                        }
                        if (preg_match('/^' . $id_category . '-?_thumb.jpg/i', $file) === 1) {
                            $image_url2 = \Context::getContext()->link->getMediaLink(_THEME_CAT_DIR_ . $file);
                            $data['categories'][$category->id_category]['image_urls2']['value'] = $image_url2;
                        }
                    }
                }

                $category_parent = new \Category((int) $id_category, \Context::getContext()->language->id);
            }
        }

        $show_arrows = ($settings['show_arrows'] == 'on') ? 'true' : 'false';
        $show_dots = ($settings['show_dots'] == 'on') ? 'true' : 'false';
        $autoplay = ($settings['autoplay'] == 'on') ? 'true' : 'false';

        $this->context->smarty->assign('settings', $settings);
        $this->context->smarty->assign('nov_dir', _PS_THEME_DIR_);
        $this->context->smarty->assign('tab', 'producttab' . rand(10, rand()));
        $this->context->smarty->assign('novconfig', $novconfig);
        $this->context->smarty->assign('class', $settings['class']);
        $this->context->smarty->assign('title', $settings['title']);
        $this->context->smarty->assign('sub_title', $settings['sub_title']);
        $this->context->smarty->assign('button', $settings['button']);
        $this->context->smarty->assign('link_buttom', $settings['link_buttom']);
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
        $this->context->smarty->assign('categories', $data['categories']);

        $tpl = "module:novelementor/views/templates/front/widgets/nov-product-tabs-category/{$settings['display_type']}.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
