<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovBannerProduct extends WidgetBase {

    public function getName() {
        return 'nov-banner-product';
    }

    public function getTitle() {
        return __('Nov Banner Product', 'elementor');
    }

    public function getIcon() {
        return 'vinova-icon';
    }

    public function getCategories() {
        return array('vinova');
    }

    protected function _registerControls() {
        $this->startControlsSection(
                'section_novbanner_prodtct', array(
            'label' => __('Nov Banner Product', 'elementor'),
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
                    'label' => __('Choose Image Product', 'elementor'),
                    'type' => ControlsManager::MEDIA,
                    'seo' => true,
                    'default' => array(
                        'url' => Utils::getPlaceholderImageSrc(),
                    )
                ),
                array(
                    'name' => 'image2',
                    'label' => __('Choose Image Banner', 'elementor'),
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
                    'name' => 'text2',
                    'label' => __('Title 2', 'elementor'),
                    'type' => ControlsManager::TEXT,
                    'label_block' => true,
                    'placeholder' => __('List Item 2', 'elementor'),
                    'default' => __('List Item', 'elementor'),
                ),
                array(
                    'name' => "text3",
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
                'show_arrows', array(
            'label' => __('Show Arrows', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
                )
        );

        $this->addControl(
                'show_dots', array(
            'label' => __('Show Dots', 'elementor'),
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
        $this->addControl(
                'spacing', array(
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
                'text3' => $item['text3'],
                'button' => $item['button'],
                'url' => $item['link']['url'],
                'src' => Helper::getMediaLink($item['image']['url']),
                'src2' => Helper::getMediaLink($item['image2']['url']),
                'id' => $item['image']['id'],
                'title' => isset($item['image']['title']) ? $item['image']['title'] : '',
            );
        }
        $show_arrows = ($settings['show_arrows'] == 'on') ? 'true' : 'false';
        $show_dots = ($settings['show_dots'] == 'on') ? 'true' : 'false';
        $autoplay = ($settings['autoplay'] == 'on') ? 'true' : 'false';
        $column = \NovElementor::get_classnumbercolumn($settings['columns'], $settings['columns_tablet'], $settings['columns_mobile']);
        $this->context->smarty->assign(
                array(
                    'title' => $settings['title'],
                    'sub_title' => $settings['sub_title'],
                    'images' => $images,
                    'lg' => $settings['columns'],
                    'md' => $settings['columns_tablet'],
                    'xs' => $settings['columns_mobile'],
                    'show_arrows' => $settings['show_arrows'],
                    'show_dots' => $settings['show_dots'],
                    'autoplay' => $settings['autoplay'],
                    'column' => $column,
                    'spacing' => $settings['spacing'],
                    'el_class' => ''
                )
        );

        $tpl = "module:novelementor/views/templates/front/widgets/nov-banner-product/slider-type-1.tpl";
        echo $this->context->smarty->fetch($tpl);
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
