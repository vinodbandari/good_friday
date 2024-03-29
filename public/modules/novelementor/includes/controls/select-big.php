<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlSelectBig extends ControlBase
{
    public function getType()
    {
        return 'select_big';
    }

    public function contentTemplate()
    {
        ?>
        <div class="elementor-control-field">
            <label class="elementor-control-title">{{{ data.label }}}</label>
            <div class="elementor-control-input-wrapper">
                <select data-setting="{{ data.name }}"  <# if ( data.multiple ) { #> multiple <# } #>>
                <# _.each( data.options, function( option_title, option_value ) { #>
                    <option value="{{ option_value }}">{{{ option_title }}}</option>
                <# } ); #>
                </select>
            </div>
        </div>
        <# if ( data.description ) { #>
            <div class="elementor-control-description">{{{ data.description }}}</div>
        <# } #>
        <?php
    }
}
