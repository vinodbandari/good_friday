<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlText extends ControlBase
{
    public function getType()
    {
        return 'text';
    }

    public function contentTemplate()
    {
        ?>
        <div class="elementor-control-field">
            <label class="elementor-control-title">{{{ data.label }}}</label>
            <div class="elementor-control-input-wrapper">
                <input type="{{ data.input_type }}" class="tooltip-target" data-tooltip="{{ data.title }}" title="{{ data.title }}" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}" />
            </div>
        </div>
        <# if ( data.description ) { #>
        <div class="elementor-control-description">{{{ data.description }}}</div>
        <# } #>
        <?php
    }

    public function getDefaultSettings()
    {
        return array(
            'input_type' => 'text',
        );
    }
}
