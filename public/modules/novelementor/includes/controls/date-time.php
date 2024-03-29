<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlDateTime extends ControlBase
{
    public function getType()
    {
        return 'date_time';
    }

    public function getDefaultSettings()
    {
        return array(
            'label_block' => true,
        );
    }

    public function contentTemplate()
    {
        ?>
        <div class="elementor-control-field">
            <label class="elementor-control-title">{{{ data.label }}}</label>
            <div class="elementor-control-input-wrapper">
                <input class="elementor-date-time-picker" type="text" data-setting="{{ data.name }}">
            </div>
        </div>
        <# if ( data.description ) { #>
            <div class="elementor-control-description">{{{ data.description }}}</div>
        <# } #>
        <?php
    }
}
