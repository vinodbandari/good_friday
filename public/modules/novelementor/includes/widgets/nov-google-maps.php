<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovGoogleMaps extends WidgetBase
{
    public function getName()
    {
        return 'nov-google-maps';
    }

    public function getTitle()
    {
        return __('Nov Google Maps', 'elementor');
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
            'section_novmaps',
            array(
                'label' => __('Nov Google Maps Settings', 'elementor'),
            )
        );

        $this->addControl(
            'title',
            array(
                'label' => __('Title', 'elementor'),
                'type' => ControlsManager::TEXT,
                'placeholder' => '',
                'label_block' => true,
            )
        );

        $this->addControl(
            'sub_title',
            array(
                'label' => __('Sub Title', 'elementor'),
                'type' => ControlsManager::TEXT,
                'placeholder' => '',
                'label_block' => true,
            )
        );

        $this->addControl(
            'desc_title',
            array(
                'label' => __('Description Title', 'elementor'),
                'type' => ControlsManager::TEXT,
                'placeholder' => '',
                'label_block' => true,
            )
        );

        $default_address = __('London Eye, London, United Kingdom', 'elementor');
        $this->addControl(
            'address',
            array(
                'label' => __('Address', 'elementor'),
                'type' => ControlsManager::TEXT,
                'placeholder' => $default_address,
                'default' => $default_address,
                'label_block' => true,
            )
        );

        $this->addControl(
            'zoom',
            array(
                'label' => __('Zoom Level', 'elementor'),
                'type' => ControlsManager::SLIDER,
                'default' => array(
                    'size' => 10,
                ),
                'range' => array(
                    'px' => array(
                        'min' => 1,
                        'max' => 20,
                    ),
                ),
            )
        );

        $this->addControl(
            'height',
            array(
                'label' => __('Height', 'elementor'),
                'type' => ControlsManager::SLIDER,
                'default' => array(
                    'size' => 300,
                ),
                'range' => array(
                    'px' => array(
                        'min' => 40,
                        'max' => 1440,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} iframe' => 'height: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->addControl(
            'prevent_scroll',
            array(
                'label' => __('Prevent Scroll', 'elementor'),
                'type' => ControlsManager::SELECT,
                'default' => 'yes',
                'options' => array(
                    '' => __('No', 'elementor'),
                    'yes' => __('Yes', 'elementor'),
                ),
                'selectors' => array(
                    '{{WRAPPER}} iframe' => 'pointer-events: none;',
                ),
            )
        );

        $this->addControl(
            'view',
            array(
                'label' => __('View', 'elementor'),
                'type' => ControlsManager::HIDDEN,
                'default' => 'traditional',
            )
        );

        $this->addControl(
            'display_type',
            array(
                'label' => __('Display Style', 'elementor'),
                'type' => ControlsManager::SELECT,
                'default' => 'style-silver',
                'options' => array(
                    'style-silver' => __('Style Silver', 'elementor'),
                )
            )
        );

        $this->endControlsSection();
    }

    protected function render()
    {
        $settings = $this->getSettings();

        if (empty($settings['address'])) {
            return;
        }

        if (0 === absint($settings['zoom']['size'])) {
            $settings['zoom']['size'] = 10;
        }

        $this->context->smarty->assign(
            array(
                'title' => $settings['title'],
                'sub_title' => $settings['sub_title'],
                'desc_title' => $settings['desc_title'],
                'zoom' => $settings['zoom']['size'],
                'height' => $settings['height']['size'],
                'address' => $settings['address'],
                'el_class' => '',
            )
        );

        $tpl = "module:novelementor/views/templates/front/widgets/nov-google-maps/{$settings['display_type']}.tpl";
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
