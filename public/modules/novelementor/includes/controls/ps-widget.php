<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlPsWidget extends ControlBase
{
    public function getType()
    {
        return 'ps_widget';
    }

    public function contentTemplate()
    {
        ?>
        <form action="" method="post">
            <div class="wp-widget-form-loading">Loading..</div>
        </form>
        <?php
    }
}
