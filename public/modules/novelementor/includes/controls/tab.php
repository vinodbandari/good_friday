<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlTab extends ControlBase
{

    public function getType()
    {
        return 'tab';
    }

    public function contentTemplate()
    {
        ?>
        <# if ( ! data.is_tabs_wrapper ) { #>
            <div class="elementor-panel-tab-heading">
                {{{ data.label }}}
            </div>
        <# } #>
        <?php
    }

    protected function getDefaultSettings()
    {
        return array(
            'separator' => 'none',
        );
    }
}
