<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovComingSoon extends WidgetBase
{
    public function getName()
    {
        return 'nov-coming-soon';
    }

    public function getTitle()
    {
        return __('Nov Coming Soon', 'elementor');
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
            'section_coming_settings',
            array(
                'label' => __('Nov Coming Soon Settings', 'elementor'),
            )
        );

        $this->addControl(
            'image',
            array(
                'label' => __('Image', 'elementor'),
                'type' => ControlsManager::MEDIA,
                'seo' => true,
                'default' => array(
                    'url' => Utils::getPlaceholderImageSrc(),
                ),
            )
        );
        $this->addControl(
            'title_1',
            array(
                'label' => __('Title 1', 'elementor'),
                'type' => ControlsManager::TEXT,
                'default' => ''
            )
        );
        $this->addControl(
            'title_2',
            array(
                'label' => __('Title 2', 'elementor'),
                'type' => ControlsManager::TEXT,
                'default' => ''
            )
        );
        $this->addControl(
            'description',
            array(
                'label' => __('Description', 'elementor'),
                'type' => ControlsManager::TEXTAREA,
                'rows' => 10,
                'default' => ''
            )
        );
        $this->addControl(
            'date',
            array(
                'label' => __('Coming Date', 'elementor'),
                'type' => ControlsManager::DATE_TIME,
                'default' => ''
            )
        );
        $this->addControl(
            'coming_style',
            array(
                'label' => __('Style', 'elementor'),
                'type' => ControlsManager::SELECT2,
                'default' => 'style-1',
                'options' => array(
                    'style-1' => __('Style 1', 'elementor'),
                    'style-2' => __('Style 2', 'elementor'),
                    'style-3' => __('Style 3', 'elementor')
                )
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
        $settings = $this->getSettings();
        $settings['image']['url'] = Helper::getMediaLink($settings['image']['url']);
        $this->context->smarty->assign('settings', $settings);
        $tpl = "module:novelementor/views/templates/front/widgets/nov-coming-soon/{$settings['coming_style']}.tpl";
        echo $this->context->smarty->fetch($tpl);
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
