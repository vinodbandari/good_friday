<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovInstagram extends WidgetBase {

    public function getName() {
        return 'nov-instagram';
    }

    public function getTitle() {
        return __('Nov Instagram', 'elementor');
    }

    public function getIcon() {
        return 'vinova-icon';
    }

    public function getCategories() {
        return array('vinova');
    }

    protected function _registerControls() {
        $this->startControlsSection(
                'section_instagram_settings', array(
            'label' => __('Nov Instagram Settings', 'elementor'),
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
            'default' => '',
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
                'adress', array(
            'label' => __('Adress', 'elementor'),
            'type' => ControlsManager::TEXT,
            'default' => '',
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
                'image2', array(
            'label' => __('Image 2', 'elementor'),
            'type' => ControlsManager::MEDIA,
            'seo' => true,
            'default' => array(
                'url' => Utils::getPlaceholderImageSrc(),
            ),
                )
        );
        $this->addControl(
                'image3', array(
            'label' => __('Image 3', 'elementor'),
            'type' => ControlsManager::MEDIA,
            'seo' => true,
            'default' => array(
                'url' => Utils::getPlaceholderImageSrc(),
            ),
                )
        );
        $this->addControl(
                'image4', array(
            'label' => __('Image 4', 'elementor'),
            'type' => ControlsManager::MEDIA,
            'seo' => true,
            'default' => array(
                'url' => Utils::getPlaceholderImageSrc(),
            ),
                )
        );
        $this->addControl(
                'image5', array(
            'label' => __('Image 5', 'elementor'),
            'type' => ControlsManager::MEDIA,
            'seo' => true,
            'default' => array(
                'url' => Utils::getPlaceholderImageSrc(),
            ),
                )
        );
        $this->addControl(
                'image6', array(
            'label' => __('Image 6', 'elementor'),
            'type' => ControlsManager::MEDIA,
            'seo' => true,
            'default' => array(
                'url' => Utils::getPlaceholderImageSrc(),
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
        $settings['image3']['url'] = Helper::getMediaLink($settings['image3']['url']);
        $settings['image4']['url'] = Helper::getMediaLink($settings['image4']['url']);
        $settings['image5']['url'] = Helper::getMediaLink($settings['image5']['url']);
        $settings['image6']['url'] = Helper::getMediaLink($settings['image6']['url']);
        $this->context->smarty->assign('settings', $settings);
        $tpl = "module:novelementor/views/templates/front/widgets/nov-instagram/style-1.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
