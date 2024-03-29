<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovNivoSlider extends WidgetBase {

    public function getName() {
        return 'nov-nivo-slider';
    }

    public function getTitle() {
        return __('Nov Nivo Slider', 'elementor');
    }

    public function getIcon() {
        return 'vinova-icon';
    }

    public function getCategories() {
        return array('vinova');
    }

    protected function _listingOptionSlide() {
        $slides = array();

        $array_slides = $this->getSlides();

        if ($array_slides) {
            foreach ($array_slides as $array_slide) {
                $slides[$array_slide['id_slide']] = $array_slide['title'];
            }
        }

        return $slides;
    }

    protected function getSlides($filter = null) {
        $id_shop = \Context::getContext()->shop->id;
        $id_lang = \Context::getContext()->language->id;

        return \Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
				SELECT hs.`id_novnivoslider_slides` as id_slide, hssl.`image`, hss.`position`,hss.`align`,hss.`effect_title`,hss.`effect_description`,hss.`effect_html`,hss.`active`, hssl.`title`,
				hssl.`url`, hssl.`legend`, hssl.`description`, hssl.`image`, hssl.`html`
				FROM ' . _DB_PREFIX_ . 'novnivoslider hs
				LEFT JOIN ' . _DB_PREFIX_ . 'novnivoslider_slides hss ON (hs.id_novnivoslider_slides = hss.id_novnivoslider_slides)
				LEFT JOIN ' . _DB_PREFIX_ . 'novnivoslider_slides_lang hssl ON (hss.id_novnivoslider_slides = hssl.id_novnivoslider_slides)
				WHERE id_shop = ' . (int) $id_shop . '
				AND hssl.id_lang = ' . (int) $id_lang .
                        ' AND hss.`active` = 1 '
                        . ($filter ? $filter : ' ') . '
				ORDER BY hssl.title'
        );
    }

    protected function _registerControls() {
        $this->startControlsSection(
                'section_nivoslider_settings', array(
            'label' => __('Nov Nivo Slider Settings', 'elementor'),
                )
        );

        $this->addControl(
                'title', array(
            'label' => __('Title', 'elementor'),
            'type' => ControlsManager::TEXT,
            'default' => '',
            'required' => true
                )
        );

        $this->addControl(
                'class', array(
            'label' => __('Class', 'elementor'),
            'type' => ControlsManager::TEXT,
            'default' => '',
                )
        );
        $this->addControl(
                'display_type', array(
            'label' => __('Style Slider', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'style-1',
            'options' => array(
                'style-1' => __('Style Slider 1', 'elementor'),
                'style-2' => __('Style Slider 2', 'elementor'),
            ),
                )
        );
        $this->addControl(
                'show_title', array(
            'label' => __('Show Title', 'elementor'),
            'type' => ControlsManager::SWITCHER,
            'label_on' => 'Yes',
            'label_off' => 'No'
                )
        );

        $this->addControl(
                'effect', array(
            'label' => __('Effect', 'elementor'),
            'type' => ControlsManager::SELECT2,
            'default' => 'random',
            'options' => array(
                'random' => __('Random', 'elementor'),
                'fold' => __('Fold', 'elementor'),
                'fade' => __('Fade', 'elementor'),
                'sliceDown' => __('SliceDown', 'elementor'),
            )
                )
        );

        $this->addControl(
                'slices', array(
            'label' => __('Slices', 'elementor'),
            'type' => ControlsManager::TEXT,
            'default' => '15',
            'description' => __('For slice animations.', 'elementor'),
                )
        );

        $this->addControl(
                'animspeed', array(
            'label' => __('Animal Speed', 'elementor'),
            'type' => ControlsManager::NUMBER,
            'default' => '500',
            'description' => __('Slide transition speed', 'elementor'),
                )
        );

        $this->addControl(
                'pausetime', array(
            'label' => __('Pause Time', 'elementor'),
            'type' => ControlsManager::NUMBER,
            'default' => '10000',
            'description' => __('How long each slide will show', 'elementor'),
                )
        );

        $this->addControl(
                'startslide', array(
            'label' => __('Start Slide', 'elementor'),
            'type' => ControlsManager::NUMBER,
            'default' => '0',
            'description' => __('Set starting Slide (0 index)', 'elementor'),
                )
        );

        $this->addControl(
                'directionnav', array(
            'label' => __('Direction navigation', 'elementor'),
            'type' => ControlsManager::SWITCHER,
            'label_on' => 'Yes',
            'label_off' => 'No',
            'description' => __('Next & Prev navigation', 'elementor'),
                )
        );

        $this->addControl(
                'controlnav', array(
            'label' => __('Control navigation', 'elementor'),
            'type' => ControlsManager::SWITCHER,
            'label_on' => 'Yes',
            'label_off' => 'No',
            'description' => __('1,2,3... navigation', 'elementor'),
                )
        );

        $this->addControl(
                'ctrnavthumbs', array(
            'label' => __('Control navigation thumbail', 'elementor'),
            'type' => ControlsManager::SWITCHER,
            'label_on' => 'Yes',
            'label_off' => 'No',
            'description' => __('Use thumbnails for Control Nav', 'elementor'),
                )
        );

        $this->addControl(
                'pauseonhover', array(
            'label' => __('Pause On Hover', 'elementor'),
            'type' => ControlsManager::SWITCHER,
            'label_on' => 'Yes',
            'label_off' => 'No',
            'description' => __('Stop animation while hovering', 'elementor'),
                )
        );

        $this->addControl(
                'manualadvance', array(
            'label' => __('Manual Advance', 'elementor'),
            'type' => ControlsManager::SWITCHER,
            'label_on' => 'Yes',
            'label_off' => 'No',
            'description' => __('Force manual transitions', 'elementor'),
                )
        );

        $this->addControl(
                'randomstart', array(
            'label' => __('Random Start', 'elementor'),
            'type' => ControlsManager::SWITCHER,
            'label_on' => 'Yes',
            'label_off' => 'No',
            'description' => __('Start on a random slide', 'elementor'),
                )
        );

        $this->addControl(
                'columns', array(
            'label' => __('Colums Of Pages', 'elementor'),
            'type' => ControlsManager::SELECT2,
            'default' => '12',
            'options' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10' => '10',
                '11' => '11',
                '12' => '12',
                'cus-5' => 'Custom 5',
            ),
            'description' => __('The maximum colums in Page (default: 12), cus-5 support for 5 column in 1 row', 'elementor'),
                )
        );

        $this->addControl(
                'slides', array(
            'label' => __('Slider', 'elementor'),
            'type' => ControlsManager::SELECT2,
            'default' => '',
            'multiple' => true,
            'options' => $this->_listingOptionSlide(),
            'description' => __('Select Slider For Homepage', 'elementor'),
                )
        );

        $this->addControl(
                'active', array(
            'label' => __('Active', 'elementor'),
            'type' => ControlsManager::SWITCHER,
            'label_on' => 'Yes',
            'label_off' => 'No',
            'description' => ''
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
        $table = \Db::getInstance()->execute('SHOW TABLES LIKE \'' . _DB_PREFIX_ . 'novnivoslider' . '\'');
        if (!$table) {
            echo 'Please install novnivoslider module first!';
        } else {
            $settings = $this->getSettings();
            $slides = array();
            $id_slider = $settings['slides'];
            if (empty($id_slider) || $settings['active'] != 'yes')
                return;

            $id_sliders = implode(",", $id_slider);
            $filter = ' AND  hs.`id_novnivoslider_slides` IN  (' . pSQL($id_sliders) . ')';
            $slides = $this->getSlides($filter);
            if (is_array($slides)) {
                foreach ($slides as &$slide) {
                    $slide['sizes'] = @getimagesize((dirname(__FILE__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $slide['image']));
                    if (isset($slide['sizes'][3]) && $slide['sizes'][3])
                        $slide['size'] = $slide['sizes'][3];
                }
            }

            $this->context->smarty->assign(
                    array(
                        'settings' => $settings,
                        'slides' => $slides,
                        'directionnav' => $settings['directionnav'] == 'yes' ? '1' : '0',
                        'controlnav' => $settings['controlnav'] == 'yes' ? '1' : '0',
                        'ctrnavthumbs' => $settings['ctrnavthumbs'] == 'yes' ? '1' : '0',
                        'pauseonhover' => $settings['pauseonhover'] == 'yes' ? '1' : '0',
                        'manualadvance' => $settings['manualadvance'] == 'yes' ? '1' : '0',
                        'randomstart' => $settings['randomstart'] == 'yes' ? '1' : '0',
                    )
            );
            $tpl = "module:novelementor/views/templates/front/widgets/nov-nivo-slider/{$settings['display_type']}.tpl";
            echo $this->context->smarty->fetch($tpl);
        }
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
