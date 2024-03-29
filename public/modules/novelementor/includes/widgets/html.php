<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetHtml extends WidgetBase
{
    public function getName()
    {
        return 'html';
    }

    public function getTitle()
    {
        return __('HTML', 'elementor');
    }

    public function getIcon()
    {
        return 'coding';
    }

    public function getCategories()
    {
        return array('general-elements');
    }

    protected function _registerControls()
    {
        $this->startControlsSection(
            'section_title',
            array(
                'label' => __('HTML Code', 'elementor'),
            )
        );

        $this->addControl(
            'html',
            array(
                'label' => '',
                'type' => ControlsManager::TEXTAREA,
                'default' => '',
                'placeholder' => __('Enter your embed code here', 'elementor'),
                'show_label' => false,
            )
        );

        $this->endControlsSection();
    }

    protected function render()
    {
        echo $this->getSettings('html');
    }

    protected function _contentTemplate()
    {
        ?>
        {{{ settings.html }}}
        <?php
    }
}
