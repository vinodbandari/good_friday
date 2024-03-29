<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovSliderText extends WidgetBase {

    public function getName() {
        return 'nov-slider-text';
    }

    public function getTitle() {
        return __('Nov Slider Text', 'elementor');
    }

    public function getIcon() {
        return 'vinova-icon';
    }

    public function getCategories() {
        return array('vinova');
    }

    protected function _registerControls() {
        $this->startControlsSection(
                'section_novslider_text', array(
            'label' => __('Nov Slider Text', 'elementor'),
            'default' => array(
                array(
                    'text' => __('List Item #1', 'elementor'),
                    'text2' => 'fa fa-check',
                    'button' => 'fa fa-check',
                    'link' => 'fa fa-check',
                ),
                array(
                    'text' => __('List Item #1', 'elementor'),
                    'text2' => 'fa fa-check',
                    'button' => 'fa fa-check',
                    'link' => 'fa fa-check',
                ),
            ),
                )
        );
        $this->addControl(
                'banner_slider', array(
            'type' => ControlsManager::REPEATER,
            'fields' => array(
                array(
                    'name' => 'text',
                    'label' => __('Description', 'elementor'),
                    'type' => ControlsManager::TEXTAREA,
                    'label_block' => true,
                    'rows' => 5,
                    'default' => ''
                ),
            ),
                )
        );

        $this->addControl(
                'view', array(
            'label' => __('View', 'elementor'),
            'type' => ControlsManager::HIDDEN,
            'default' => 'traditional',
                )
        );
        $this->addControl(
                'spacing', array(
            'label' => __('Spacing Item', 'elementor'),
            'type' => ControlsManager::NUMBER,
            'default' => 0,
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
                'autoplay', array(
            'label' => __('Autoplay', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
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

    protected function render() {
        $settings = $this->getSettings();

        $images = array();
        foreach ($settings['banner_slider'] as $item) {
            $images[] = array(
                'text' => $item['text'],
            );
        }
        $show_arrows = ($settings['show_arrows'] == 'on') ? 'true' : 'false';
        $autoplay = ($settings['autoplay'] == 'on') ? 'true' : 'false';
        $column = \NovElementor::get_classnumbercolumn($settings['columns'], $settings['columns_tablet'], $settings['columns_mobile']);
        $this->context->smarty->assign(
                array(
                    'images' => $images,
                    'lg' => $settings['columns'],
                    'md' => $settings['columns_tablet'],
                    'xs' => $settings['columns_mobile'],
                    'column' => $column,
                    'show_arrows' => $show_arrows,
                    'autoplay' => $autoplay,
                    'spacing' => $settings['spacing'],
                    'el_class' => ''
                )
        );

        $tpl = "module:novelementor/views/templates/front/widgets/nov-slider-text/slider-type-1.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
