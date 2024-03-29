<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetCommon extends WidgetBase
{
    public function getName()
    {
        return 'common';
    }

    protected function _registerControls()
    {
        $this->startControlsSection(
            '_section_style',
            array(
                'label' => __('Element Style', 'elementor'),
                'tab' => ControlsManager::TAB_ADVANCED,
            )
        );

        $this->addResponsiveControl(
            '_margin',
            array(
                'label' => __('Margin', 'elementor'),
                'type' => ControlsManager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .elementor-widget-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->addResponsiveControl(
            '_padding',
            array(
                'label' => __('Padding', 'elementor'),
                'type' => ControlsManager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .elementor-widget-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->addControl(
            '_animation',
            array(
                'label' => __('Entrance Animation', 'elementor'),
                'type' => ControlsManager::ANIMATION,
                'default' => '',
                'prefix_class' => 'animated ',
                'label_block' => true,
            )
        );

        $this->addControl(
            'animation_duration',
            array(
                'label' => __('Animation Duration', 'elementor'),
                'type' => ControlsManager::SELECT,
                'default' => '',
                'options' => array(
                    'slow' => __('Slow', 'elementor'),
                    '' => __('Normal', 'elementor'),
                    'fast' => __('Fast', 'elementor'),
                ),
                'prefix_class' => 'animated-',
                'condition' => array(
                    '_animation!' => '',
                ),
            )
        );

        $this->addControl(
            '_css_classes',
            array(
                'label' => __('CSS Classes', 'elementor'),
                'type' => ControlsManager::TEXT,

                'default' => '',
                'prefix_class' => '',
                'label_block' => true,
                'title' => __('Add your custom class WITHOUT the dot. e.g: my-class', 'elementor'),
            )
        );

        $this->endControlsSection();

        $this->startControlsSection(
            '_section_background',
            array(
                'label' => __('Background & Border', 'elementor'),
                'tab' => ControlsManager::TAB_ADVANCED,
            )
        );

        $this->addGroupControl(
            GroupControlBackground::getType(),
            array(
                'name' => '_background',
                'selector' => '{{WRAPPER}} .elementor-widget-container',
            )
        );

        $this->addGroupControl(
            GroupControlBorder::getType(),
            array(
                'name' => '_border',
                'selector' => '{{WRAPPER}} .elementor-widget-container',
            )
        );

        $this->addControl(
            '_border_radius',
            array(
                'label' => __('Border Radius', 'elementor'),
                'type' => ControlsManager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .elementor-widget-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->addGroupControl(
            GroupControlBoxShadow::getType(),
            array(
                'name' => '_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-widget-container',
            )
        );

        $this->endControlsSection();

        $this->startControlsSection(
            '_section_responsive',
            array(
                'label' => __('Responsive', 'elementor'),
                'tab' => ControlsManager::TAB_ADVANCED,
            )
        );

        $this->addControl(
            'responsive_description',
            array(
                'raw' => __('Attention: The display settings (show/hide for mobile, tablet or desktop) will only take effect once you are on the preview or live page, and not while you\'re in editing mode in Elementor.', 'elementor'),
                'type' => ControlsManager::RAW_HTML,
                'classes' => 'elementor-descriptor',
            )
        );

        $this->addControl(
            'hide_desktop',
            array(
                'label' => __('Hide On Desktop', 'elementor'),
                'type' => ControlsManager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => 'Hide',
                'label_off' => 'Show',
                'return_value' => 'hidden-desktop',
            )
        );

        $this->addControl(
            'hide_tablet',
            array(
                'label' => __('Hide On Tablet', 'elementor'),
                'type' => ControlsManager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => 'Hide',
                'label_off' => 'Show',
                'return_value' => 'hidden-tablet',
            )
        );

        $this->addControl(
            'hide_mobile',
            array(
                'label' => __('Hide On Mobile', 'elementor'),
                'type' => ControlsManager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => 'Hide',
                'label_off' => 'Show',
                'return_value' => 'hidden-phone',
            )
        );

        $this->endControlsSection();
    }
}
