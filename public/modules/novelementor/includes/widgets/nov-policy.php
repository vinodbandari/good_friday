<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovPolicy extends WidgetBase {

    public function getName() {
        return 'nov-policy';
    }

    public function getTitle() {
        return __('Nov Policy', 'elementor');
    }

    public function getIcon() {
        return 'vinova-icon';
    }

    public function getCategories() {
        return array('vinova');
    }

    protected function _registerControls() {
        $this->startControlsSection(
                'section_policy_settings', array(
            'label' => __('Nov Banner Settings', 'elementor'),
                )
        );
        $this->addControl(
                'display_type', array(
            'label' => __('Display Style', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'style-1',
            'options' => array(
                'style-1' => __('Policy stype 1', 'elementor'),
                'style-2' => __('Policy Stype 2', 'elementor'),
                'style-3' => __('Policy Stype 3', 'elementor'),
                'style-4' => __('Policy Stype 4', 'elementor')
            )
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
            'title',
            array(
                'label' => __('Title', 'elementor'),
                'type' => ControlsManager::TEXT,
                'default' => ''
            )
        );
        $this->addControl(
            'content',
            array(
                'label' => __('Description', 'elementor'),
                'type' => ControlsManager::TEXTAREA,
                'rows' => 5,
                'default' => ''
            )
        );

        $this->endControlsSection();
        $this->startControlsSection(
                'section_background', array(
            'label' => __('Background', 'elementor'),
            'tab' => ControlsManager::TAB_STYLE,
                )
        );
        $this->addControl(
                'sub_title_color', array(
            'label' => __('Background Type', 'elementor'),
            'type' => ControlsManager::COLOR,
            'default' => '#fff',
            'selectors' => array(
                '{{WRAPPER}} .nov-policy .block_content' => 'background-color: {{VALUE}};',
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
        $settings['image']['url'] = Helper::getMediaLink($settings['image']['url']);
        $this->context->smarty->assign('settings', $settings);
        $tpl = "module:novelementor/views/templates/front/widgets/nov-policy/{$settings['display_type']}.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
