<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovManufacture extends WidgetBase
{
    public function getName()
    {
        return 'nov-manufacture';
    }

    public function getTitle()
    {
        return __('Nov Manufacture', 'elementor');
    }

    public function getIcon()
    {
        return 'vinova-icon';
    }

    public function getCategories()
    {
        return array('vinova');
    }

    protected function _skinOptions()
    {
        $opts = array();
        $tpls = glob(_PS_THEME_DIR_ . 'templates/catalog/_partials/miniatures/*product*.tpl');

        foreach ($tpls as $tpl) {
            $opt = basename($tpl, '.tpl');
            $opts[$opt] = \Tools::ucFirst($opt);
        }

        return $opts;
    }

    protected function _listingOptions()
    {
        $opts = array(
            'category' => __('Featured Products', 'elementor'),
            'prices-drop' => __('Prices Drop', 'elementor'),
            'new-products' => __('New Products', 'elementor'),
        );

        if (!\Configuration::get('PS_CATALOG_MODE')) {
            $opts['best-sales'] = __('Best Sales', 'elementor');
        }

        return $opts;
    }

    protected function _registerControls()
    {
        $this->startControlsSection(
            'section_manufacture_settings',
            array(
                'label' => __('Nov Manufacture Settings', 'elementor'),
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
            'limit',
            array(
                'label' => __('Limit', 'elementor'),
                'type' => ControlsManager::NUMBER,
                'default' => '12'
            )
        );


        $this->addControl(
            'number_row',
            array(
                'label' => __('Number Row', 'elementor'),
                'type' => ControlsManager::SELECT,
                'default' => '1',
                'options' => array(
                    '1' => __('1', 'elementor'),
                    '2' => __('2', 'elementor'),
                    '3' => __('3', 'elementor')
                ),
            )
        );

        $this->addControl(
            'spacing',
            array(
                'label' => __('Spacing brand', 'elementor'),
                'type' => ControlsManager::NUMBER,
                'default' => '30',
            )
        );

        $this->addControl(
            'autoplay',
            array(
                'label' => __('Autoplay', 'elementor'),
                'type' => ControlsManager::CHECKBOX,
                'default' => false,
            )
        );

        $this->addResponsiveControl(
            'columns',
            array(
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
                $controls['_css_classes']['default'] = 'pt-20';
            }
        }

        return $controls;
    }

    protected function render()
    {
        $settings = $this->getSettings();

        $manus = \Manufacturer::getManufacturers(true, $this->context->language->id, true, false ,$settings['limit'], false, true, true);
        foreach ($manus as &$item) {
            $id_images = (!file_exists(_PS_MANU_IMG_DIR_.'/'.$item['id_manufacturer'].'.jpg')) ? Language::getIsoById($this->context->language->id): $item['id_manufacturer'];
            $item['image'] = _THEME_MANU_DIR_.$id_images.'.jpg';
            $item['url'] = $this->context->link->getManufacturerLink(new \Manufacturer($item['id_manufacturer'], $this->context->language->id),null, $this->context->language->id);
        }
        $autoplay = ($settings['autoplay'] == 'on') ? 'true' : 'false';
        $column = \NovElementor::get_classnumbercolumn($settings['columns'], $settings['columns_tablet'], $settings['columns_mobile']);
        $this->context->smarty->assign('settings', $settings);
        $this->context->smarty->assign('manus', $manus);
        $this->context->smarty->assign('column', $column);
        $this->context->smarty->assign('autoplay', $autoplay);

        $tpl = "module:novelementor/views/templates/front/widgets/nov-manufacture/slider-type.tpl";
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
