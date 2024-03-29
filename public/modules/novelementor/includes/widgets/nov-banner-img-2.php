<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovBannerimg2 extends WidgetBase {

    public function getName() {
        return 'nov-banner-img2';
    }

    public function getTitle() {
        return __('Nov Banner Img 2', 'elementor');
    }

    public function getIcon() {
        return 'vinova-icon';
    }

    public function getCategories() {
        return array('vinova');
    }

    protected function _registerControls() {
        $this->startControlsSection(
                'section_bannerimg2_settings', array(
            'label' => __('Nov Banner 2 Settings', 'elementor'),
                )
        );
        $this->addControl(
                'display_type', array(
            'label' => __('Banner Style', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'banner-type-1',
            'options' => array(
                'banner-type-1' => __('Banner Stype 1', 'elementor'),
                'banner-type-2' => __('Banner Stype 2', 'elementor')
            )
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
                'content', array(
            'label' => __('Description', 'elementor'),
            'type' => ControlsManager::TEXTAREA,
            'rows' => 5,
            'default' => ''
                )
        );
        $this->addControl(
                'image', array(
            'label' => __('Image 1', 'elementor'),
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
            'label' => __('Button 1', 'elementor'),
            'type' => ControlsManager::TEXT,
            'label_block' => true,
            'default' => ''
                )
        );
        $this->addControl(
                'link_buttom', array(
            'label' => __('Link buttom 1', 'elementor'),
            'type' => ControlsManager::URL,
            'placeholder' => 'http://your-link.com',
            'default' => array(
                'url' => '#',
            ),
                )
        );
        $this->addControl(
                'image2', array(
            'label' => __('Image 2', 'elementor'),
            'type' => ControlsManager::MEDIA,
            'seo' => true,
            'default' => array(
                'url' => Utils::getPlaceholderImageSrc(),
            ),
            'condition' => array(
                'display_type' => array('banner-type-1'),
            ),
                )
        );
        $this->addControl(
                'button2', array(
            'name' => "button2",
            'label' => __('Button 2', 'elementor'),
            'type' => ControlsManager::TEXT,
            'label_block' => true,
            'default' => ''
                )
        );
        $this->addControl(
                'link_buttom2', array(
            'label' => __('Link buttom 2', 'elementor'),
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
        $settings['image2']['url'] = Helper::getMediaLink($settings['image2']['url']);
        $this->context->smarty->assign('settings', $settings);
        $tpl = "module:novelementor/views/templates/front/widgets/nov-banner-img-2/{$settings['display_type']}.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
