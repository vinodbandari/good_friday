<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovTestimonials extends WidgetBase
{
    public function getName()
    {
        return 'nov-testimonials';
    }

    public function getTitle()
    {
        return __('Nov Testimonials', 'elementor');
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
            'section_testimonials_settings',
            array(
                'label' => __('Nov Testimonial Settings', 'elementor'),
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
            'sub_title',
            array(
                'label' => __('Sub Title', 'elementor'),
                'type' => ControlsManager::TEXT,
                'default' => '',
                'condition' => array(
                    'display_type' => array('slider-type-6'),
                ),
            )
        );

        $this->addControl(
            'title_align',
            array(
                'label' => __('Title Align', 'elementor'),
                'type' => ControlsManager::SELECT,
                'default' => 'left',
                'options' => array(
                    'left' => __('Left', 'elementor'),
                    'center' => __('Center', 'elementor'),
                    'right' => __('Right', 'elementor'),
                )
            )
        );
        $this->addControl(
                'display_type', array(
            'label' => __('Display Style', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'slider-type-1',
            'options' => array(
                'slider-type-1' => __('Slider Stype 1', 'elementor'),
                'slider-type-2' => __('Slider Stype 2', 'elementor'),
                'slider-type-3' => __('Slider Stype 3', 'elementor'),
                'slider-type-4' => __('Slider Stype 4', 'elementor')
                )
            )
        );
        $this->addControl(
            'limit',
            array(
                'label' => __('Limit', 'elementor'),
                'type' => ControlsManager::NUMBER,
                'default' => 12
            )
        );

        $this->addControl(
            'number_row',
            array(
                'label' => __('Number Row', 'elementor'),
                'type' => ControlsManager::SELECT,
                'default' => '1',
                'options' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3'
                ),
            )
        );

        $this->addControl(
            'show_arrows',
            array(
                'label' => __('Show Arrows', 'elementor'),
                'type' => ControlsManager::CHECKBOX,
                'default' => false,
            )
        );

        $this->addControl(
            'show_dots',
            array(
                'label' => __('Show Dots', 'elementor'),
                'type' => ControlsManager::CHECKBOX,
                'default' => false,
            )
        );

        $this->addControl(
            'autoplay',
            array(
                'label' => __('Autoplay', 'elementor'),
                'type' => ControlsManager::CHECKBOX,
                'default' => false,
            )
        );

        $this->addResponsiveControl(
            'columns',
            array(
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

    public function getControls($control_id = null)
    {
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

    protected function render()
    {
        $table = \Db::getInstance()->execute('SHOW TABLES LIKE \''._DB_PREFIX_.'novtestimonials'.'\'');
        if (!$table) {
            echo 'Please install novtestimonials module first!';
        }
        else {
            $settings = $this->getSettings();

            $show_arrows = ($settings['show_arrows'] == 'on') ? 'true' : 'false';
            $show_dots = ($settings['show_dots'] == 'on') ? 'true' : 'false';
            $autoplay = ($settings['autoplay'] == 'on') ? 'true' : 'false';

            $testimonials = \NovElementor::getTestimonialss(true, $settings['limit']);

            $column = \NovElementor::get_classnumbercolumn($settings['columns'], $settings['columns_tablet'], $settings['columns_mobile'], $settings['number_row']);

            if(\Configuration::get('PS_SSL_ENABLED'))
                $image_path = _PS_BASE_URL_SSL_._MODULE_DIR_."novtestimonials/images/";
            else
                $image_path = _PS_BASE_URL_._MODULE_DIR_."novtestimonials/images/";

            $this->context->smarty->assign(
                array(
                    'testimonials' => $testimonials,
                    'image_path' => $image_path,
                    'title' => $settings['title'],
                    'sub_title' => $settings['sub_title'],
                    'title_align' => $settings['title_align'],
                    'xl' => $settings['columns'],
                    'md' => $settings['columns_tablet'],
                    'xs' => $settings['columns_mobile'],
                    'column' => $column,
                    'number_row' => $settings['number_row'],
                    'show_arrows' => $show_arrows,
                    'show_dots' => $show_dots,
                    'autoplay' => $autoplay,
                    'el_class' => ''
                )
            );

            $tpl = "module:novelementor/views/templates/front/widgets/nov-testimonials/{$settings['display_type']}.tpl";
            echo $this->context->smarty->fetch($tpl);
        }
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
