<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlHeading extends ControlBase
{
    public function getType()
    {
        return 'heading';
    }

    protected function getDefaultSettings()
    {
        return array(
            'label_block' => true,
        );
    }

    public function contentTemplate()
    {
        ?>
        <h3 class="elementor-control-title">{{ data.label }}</h3>
        <?php
    }
}
