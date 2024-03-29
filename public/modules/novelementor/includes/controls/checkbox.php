<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlCheckbox extends ControlBase
{
    public function getType()
    {
        return 'checkbox';
    }

    public function contentTemplate()
    {
        ?>
        <label class="elementor-control-title">
            <span>{{{ data.label }}}</span>
            <input type="checkbox" data-setting="{{ data.name }}" />
        </label>
        <# if ( data.description ) { #>
        <div class="elementor-control-description">{{{ data.description }}}</div>
        <# } #>
        <?php
    }
}
