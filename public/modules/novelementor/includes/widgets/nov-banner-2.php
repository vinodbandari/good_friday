<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovBanner2 extends WidgetBase {

    public function getName() {
        return 'nov-banner-2';
    }

    public function getTitle() {
        return __('Nov Banner 2', 'elementor');
    }

    public function getIcon() {
        return 'vinova-icon';
    }

    public function getCategories() {
        return array('vinova');
    }

    protected function _registerControls() {
        $this->startControlsSection(
                'section_banner2_settings', array(
            'label' => __('Nov Banner Settings', 'elementor'),
                )
        );
        $this->addControl(
                'display_type', array(
            'label' => __('Banner Style', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'banner-type-1',
            'options' => array(
                'banner-type-1' => __('Banner Stype 1', 'elementor'),
                'banner-type-2' => __('Banner Stype 2', 'elementor'),
                'banner-type-3' => __('Banner Stype 3', 'elementor'),
                'banner-type-4' => __('Banner Stype 4', 'elementor'),
                'banner-type-5' => __('Banner Stype 5', 'elementor'),
                'banner-type-6' => __('Banner Stype 6', 'elementor')
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
                'title', array(
            'label' => __('Title', 'elementor'),
            'type' => ControlsManager::TEXT,
            'default' => '',
                'condition' => array(
                    'display_type' => array('banner-type-1','banner-type-2','banner-type-3','banner-type-4','banner-type-5'),
            ),   
                )
        );
        $this->addControl(
            'content', array(
                'label' => __('Description', 'elementor'),
                'type' => ControlsManager::TEXTAREA,
                'rows' => 4,
                'default' => '',
                'condition' => array(
                    'display_type' => array('banner-type-1','banner-type-2','banner-type-3','banner-type-4','banner-type-5'),
            ),
                )
        );
        $this->addControl(
                'button', array(
            'name' => "button",
            'label' => __('Button', 'elementor'),
            'type' => ControlsManager::TEXT,
            'label_block' => true,
            'default' => '',
                'condition' => array(
                    'display_type' => array('banner-type-1','banner-type-2','banner-type-3','banner-type-4','banner-type-5','banner-type-6'),
            ),
                )
        );
        $this->addControl(
                'link', array(
            'label' => __('Link button', 'elementor'),
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
        $settings['image']['url'] = Helper::getMediaLink($settings['image']['url']);
        $this->context->smarty->assign('settings', $settings);
        $tpl = "module:novelementor/views/templates/front/widgets/nov-banner-2/{$settings['display_type']}.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
