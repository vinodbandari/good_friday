<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovBannerSlider extends WidgetBase {

    public function getName() {
        return 'nov-banner-slider';
    }

    public function getTitle() {
        return __('Nov Banner slider', 'elementor');
    }

    public function getIcon() {
        return 'vinova-icon';
    }

    public function getCategories() {
        return array('vinova');
    }

    protected function _registerControls() {
        $this->startControlsSection(
                'section_novbanner_slider', array(
            'label' => __('Nov Banner slider', 'elementor'),
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
            'default' => ''
                )
        );
        $this->addControl(
                'display_type', array(
            'label' => __('Display Style', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'slider-type-1',
            'options' => array(
                'slider-type-1' => __('Slider Stype 1', 'elementor'),
                'slider-type-2' => __('Slider Stype 2', 'elementor')
            )
                )
        );
        $this->addControl(
                'banner_slider', array(
            'type' => ControlsManager::REPEATER,
            'default' => array(
                array(
                    'image' => array(
                        'url' => Utils::getPlaceholderImageSrc(),
                    ),
                ),
            ),
            'fields' => array(
                array(
                    'name' => 'image',
                    'label' => __('Choose icon Image', 'elementor'),
                    'type' => ControlsManager::MEDIA,
                    'seo' => true,
                    'default' => array(
                        'url' => Utils::getPlaceholderImageSrc(),
                    )
                ),
                array(
                    'name' => 'text',
                    'label' => __('Title', 'elementor'),
                    'type' => ControlsManager::TEXT,
                    'label_block' => true,
                    'placeholder' => __('List Item', 'elementor'),
                    'default' => __('List Item', 'elementor'),
                ),
                array(
                    'name' => "text2",
                    'label' => __('Description', 'elementor'),
                    'type' => ControlsManager::TEXTAREA,
                    'label_block' => true,
                    'rows' => 5,
                    'default' => ''
                ),
                array(
                    'name' => "button",
                    'label' => __('Button', 'elementor'),
                    'type' => ControlsManager::TEXT,
                    'label_block' => true,
                    'default' => ''
                ),
                array(
                    'name' => 'link',
                    'label' => __('Link', 'elementor'),
                    'type' => ControlsManager::URL,
                    'label_block' => true,
                    'placeholder' => __('http://your-link.com', 'elementor'),
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
            'spacing',
            array(
                'label' => __('Spacing Item', 'elementor'),
                'type' => ControlsManager::NUMBER,
                'default' => 0,
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
                'text2' => $item['text2'],
                'button' => $item['button'],
                'url' => $item['link']['url'],
                'src' => Helper::getMediaLink($item['image']['url']),
                'id' => $item['image']['id'],
                'title' => isset($item['image']['title']) ? $item['image']['title'] : '',
            );
        }

        $column = \NovElementor::get_classnumbercolumn($settings['columns'], $settings['columns_tablet'], $settings['columns_mobile']);
        $this->context->smarty->assign(
                array(
                    'title' => $settings['title'],
                    'sub_title' => $settings['sub_title'],
                    'images' => $images,
                    'lg' => $settings['columns'],
                    'md' => $settings['columns_tablet'],
                    'xs' => $settings['columns_mobile'],
                    'column' => $column,
                    'spacing' => $settings['spacing'],
                    'el_class' => ''
                )
        );

        $tpl = "module:novelementor/views/templates/front/widgets/nov-banner-slider/{$settings['display_type']}.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
