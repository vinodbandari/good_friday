<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlSwitcher extends ControlBase
{
    public function getType()
    {
        return 'switcher';
    }

    public function contentTemplate()
    {
        ob_start();?>
        <div class="elementor-control-field">
            <label class="elementor-control-title">{{{ data.label }}}</label>
            <div class="elementor-control-input-wrapper">
                <label class="elementor-switch">
                    <input type="checkbox" data-setting="{{ data.name }}" class="elementor-switch-input" value="{{ data.return_value }}">
                    <span class="elementor-switch-label" data-on="{{ data.label_on }}" data-off="{{ data.label_off }}"></span>
                    <span class="elementor-switch-handle"></span>
                </label>
            </div>
        </div>
        <# if ( data.description ) { #>
        <div class="elementor-control-description">{{{ data.description }}}</div>
        <# } #>
        <?php ob_end_flush();
    }

    protected function getDefaultSettings()
    {
        return array(
            'label_off' => '',
            'label_on' => '',
            'return_value' => 'yes',
        );
    }
}
