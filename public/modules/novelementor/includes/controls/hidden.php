<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlHidden extends ControlBase
{
    public function getType()
    {
        return 'hidden';
    }

    public function contentTemplate()
    {
        ?>
        <input type="hidden" data-setting="{{{ data.name }}}" />
        <?php
    }
}
