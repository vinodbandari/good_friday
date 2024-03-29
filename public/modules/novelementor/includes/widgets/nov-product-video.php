<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovProductVideo extends WidgetBase {

    public function getName() {
        return 'nov-product-video';
    }

    public function getTitle() {
        return __('Nov Product Video', 'elementor');
    }

    public function getIcon() {
        return 'vinova-icon';
    }

    public function getCategories() {
        return array('vinova');
    }
    protected function _registerControls() {
        $this->startControlsSection(
                'section_productvideo_settings', array(
            'label' => __('Nov Product Video Settings', 'elementor'),
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
                'nov_idproduct', array(
            'label' => __('Enter the product id', 'elementor'),
            'type' => ControlsManager::TEXT,
            'default' => '3'
                )
        );
        $this->addControl(
                'display_type', array(
            'label' => __('Display Style', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'stype-1',
            'options' => array(
                'stype-1' => __('Stype 1', 'elementor'),
                'stype-2' => __('Stype 2', 'elementor'),
            )
                )
        );
        $this->addControl(
            'link_youtobe',
            array(
                'label' => __('Link iframe youtobe', 'elementor'),
                'type' => ControlsManager::URL,
                'placeholder' => 'http://your-link.com',
                'default' => array(
                    'url' => '#',
                ),
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
        $nov_productid = $settings['nov_idproduct'];
                $this->context->smarty->assign('settings', $settings);
        $context = \Context::getContext();

        $cache_products = \NovElementor::getSingleProduct($this->context->language->id,$nov_productid);
        
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

        $novconfig = \NovElementor::getConfigTheme();
        $context->smarty->assign(
                array(
                    'products' => $products_for_template,
                    'groups' => $groups,
                    'title' => $settings['title'],
                    'nov_idproduct' => $settings['nov_idproduct'],
                    'nov_dir' => _PS_THEME_DIR_,
                    'el_class' => '',
                    'number_row'=> '1',
                    'novconfig' => $novconfig,
                    'class_item' => ''
                )
        );

        $tpl = "module:novelementor/views/templates/front/widgets/nov-product-video/{$settings['display_type']}.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
