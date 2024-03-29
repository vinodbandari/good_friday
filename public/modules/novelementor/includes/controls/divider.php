<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlDivider extends ControlBase
{
    public function getType()
    {
        return 'divider';
    }

    public function contentTemplate()
    {
        ?>
        <hr />
        <?php
    }
}
