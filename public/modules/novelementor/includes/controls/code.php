<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlCode extends ControlBase
{
    public function getType()
    {
        return 'code';
    }

    public function contentTemplate()
    {
        ?>
        <div class="elementor-control-field">
            <label class="elementor-control-title">{{{ data.label }}}</label>
            <div class="elementor-control-input-wrapper">
                <textarea rows="{{ data.rows || 5 }}" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}"></textarea>
            </div>
        </div>
        <?php
    }

    protected function getDefaultSettings()
    {
        return array(
            'label_block' => true,
        );
    }
}
