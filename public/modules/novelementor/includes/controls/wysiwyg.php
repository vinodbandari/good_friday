<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlWysiwyg extends ControlBase
{
    public function getType()
    {
        return 'wysiwyg';
    }

    public function enqueue()
    {
        $baseAdminDir = __PS_BASE_URI__ . basename(_PS_ADMIN_DIR_) . '/';

        wp_enqueue_style('material-icons', _MODULE_DIR_ . 'novelementor/views/lib/material-icons/material-icons.css');
        wp_enqueue_style('tinymce-theme', _MODULE_DIR_ . 'novelementor/views/lib/tinymce/ps-theme.css');

        wp_register_script('tinymce', _PS_JS_DIR_ . 'tiny_mce/tinymce.min.js', array('jquery'), false, true);
        wp_register_script('tinymce-inc', _MODULE_DIR_ . 'novelementor/views/lib/tinymce/tinymce.inc.js', array('tinymce'), false, true);

        wp_localize_script('tinymce', 'baseAdminDir', $baseAdminDir);
        wp_localize_script('tinymce', 'iso_user', \Context::getContext()->language->iso_code);

        if (version_compare(_PS_VERSION_, '1.7', '<')) {
            wp_enqueue_script('tinymce-align', _MODULE_DIR_ . 'novelementor/views/lib/tinymce/plugins/align/plugin.min.js', array('tinymce'), false, true);
        }
        wp_enqueue_script('tinymce-inc');
    }

    public function contentTemplate()
    {
        ?>
        <label>
            <span class="elementor-control-title">{{{ data.label }}}</span>
            <textarea data-setting="{{ data.name }}"></textarea>
        </label>
        <?php
    }
}
