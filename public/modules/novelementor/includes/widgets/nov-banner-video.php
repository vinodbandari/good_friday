<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovBannerVideo extends WidgetBase {

    public function getName() {
        return 'nov-banner-video';
    }

    public function getTitle() {
        return __('Nov banner Video', 'elementor');
    }

    public function getIcon() {
        return 'vinova-icon';
    }

    public function getCategories() {
        return array('vinova');
    }

    protected function _registerControls() {
        $this->startControlsSection(
                'section_banner_video_settings', array(
            'label' => __('Nov Banner Video Settings', 'elementor'),
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
                'image', array(
            'label' => __('Image', 'elementor'),
            'type' => ControlsManager::MEDIA,
            'seo' => true,
            'default' => array(
                'url' => Utils::getPlaceholderImageSrc(),
            ),
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
            'link',
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
        $this->startControlsSection(
                'section_title', array(
            'label' => __('Title', 'elementor'),
            'tab' => ControlsManager::TAB_STYLE,
                )
        );
        $this->addResponsiveControl(
                'title_padding', array(
            'label' => __('Title Padding', 'elementor'),
            'type' => ControlsManager::DIMENSIONS,
            'size_units' => array('px', 'em', '%'),
            'selectors' => array(
                '{{WRAPPER}} .title-video' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ),
                )
        );
        $this->addControl(
                'title_color', array(
            'label' => __('Title Color', 'elementor'),
            'type' => ControlsManager::COLOR,
            'default' => '',
            'selectors' => array(
                '{{WRAPPER}} .title-video' => 'color: {{VALUE}};',
            ),
            'scheme' => array(
                'type' => SchemeColor::getType(),
                'value' => SchemeColor::COLOR_2,
            ),
                )
        );
        $this->addGroupControl(
                GroupControlTypography::getType(), array(
            'name' => 'title_typography',
            'label' => __('Typography', 'elementor'),
            'selector' => '{{WRAPPER}} .title-video',
            'scheme' => SchemeTypography::TYPOGRAPHY_3,
                )
        );
        $this->endControlsSection();
        
        $this->startControlsSection(
                'section_bottom_style', array(
            'label' => __('Bottom', 'elementor'),
            'tab' => ControlsManager::TAB_STYLE,
                )
        );
        $this->addGroupControl(
                GroupControlTypography::getType(), array(
            'name' => 'bottom_typography',
            'label' => __('Typography', 'elementor'),
            'selector' => '{{WRAPPER}} .youtube-bottom .btn-3',
            'scheme' => SchemeTypography::TYPOGRAPHY_3,
                )
        );
        
        $this->addControl(
                'border_radius', array(
            'label' => __('Border Radius', 'elementor'),
            'type' => ControlsManager::DIMENSIONS,
            'size_units' => array('px', '%'),
            'selectors' => array(
                '{{WRAPPER}} .youtube-bottom .btn-3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ),
                )
        );

        $this->addControl(
                'text_padding', array(
            'label' => __('Text Padding', 'elementor'),
            'type' => ControlsManager::DIMENSIONS,
            'size_units' => array('px', 'em', '%'),
            'selectors' => array(
                '{{WRAPPER}} .youtube-bottom .btn-3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ),
                )
        );
        
        $this->startControlsTabs('bg_effects_tabs');

        $this->startControlsTab(
            'normal',
            array(
                'label' => __('Normal', 'elementor'),
            )
        );

        $this->addControl(
            'bottom_color',
            array(
                'label' => __('Bottom Color', 'elementor'),
                'type' => ControlsManager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .youtube-bottom .btn-3:not(:hover)' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->addControl(
            'background_bottom',
            array(
                'label' => __('background-color', 'elementor'),
                'type' => ControlsManager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .youtube-bottom .btn-3:not(:hover)' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->endControlsTab();

        $this->startControlsTab(
            'hover',
            array(
                'label' => __('Hover', 'elementor'),
            )
        );

        $this->addControl(
            'bottom_color_hover',
            array(
                'label' => __('Bottom Color', 'elementor'),
                'type' => ControlsManager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .youtube-bottom:hover .btn-3' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->addControl(
            'background_color_hover',
            array(
                'label' => __('background Color', 'elementor'),
                'type' => ControlsManager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .youtube-bottom:hover .btn-3' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->endControlsTab();

        $this->endControlsTabs();
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
        $settings['image']['url'] = Helper::getMediaLink($settings['image']['url']);
        $this->context->smarty->assign('settings', $settings);
        $tpl = "module:novelementor/views/templates/front/widgets/nov-banner-video/default.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
