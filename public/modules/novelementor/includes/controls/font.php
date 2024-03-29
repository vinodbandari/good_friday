<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlFont extends ControlBase
{
    public function getType()
    {
        return 'font';
    }

    protected function getDefaultSettings()
    {
        return array(
            'fonts' => Fonts::getFonts(),
        );
    }

    public function contentTemplate()
    {
        ?>
        <div class="elementor-control-field">
            <label class="elementor-control-title">{{{ data.label }}}</label>
            <div class="elementor-control-input-wrapper">
                <select class="elementor-control-font-family" data-setting="{{ data.name }}">
                    <option value=""><?php _e('Default', 'elementor');?></option>
                    <optgroup label="<?php _e('System', 'elementor');?>">
                        <# _.each( getFontsByGroups( 'system' ), function( fontType, fontName ) { #>
                        <option value="{{ fontName }}">{{{ fontName }}}</option>
                        <# } ); #>
                    </optgroup>
                    <optgroup label="<?php _e('Google', 'elementor');?>">
                        <# _.each( getFontsByGroups( [ 'googlefonts', 'earlyaccess' ] ), function( fontType, fontName ) { #>
                        <option value="{{ fontName }}">{{{ fontName }}}</option>
                        <# } ); #>
                    </optgroup>
                </select>
            </div>
        </div>
        <# if ( data.description ) { #>
        <div class="elementor-control-description">{{{ data.description }}}</div>
        <# } #>
        <?php
    }
}
