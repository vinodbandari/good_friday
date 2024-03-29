<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlRepeater extends ControlBase
{
    public function getType()
    {
        return 'repeater';
    }

    protected function getDefaultSettings()
    {
        return array(
            'prevent_empty' => true,
        );
    }

    public function onImport(&$settings)
    {
        $import_images = Plugin::instance()->templates_manager->getImportImagesInstance();

        foreach ($settings as &$item) {
            // import already handled
            if (!empty($item['_imported'])) {
                unset($item['_imported']);
                continue;
            }

            foreach ($item as &$subitem) {
                // handle MEDIA type
                if (isset($subitem['id'], $subitem['url'])) {
                    $subitem = $import_images->import($subitem);

                    if (!$subitem) {
                        $subitem = array(
                            'id' => 0,
                            'url' => Utils::getPlaceholderImageSrc(),
                        );
                    }
                }
            }
        }

        return $settings;
    }

    public function onExport(&$settings)
    {
        foreach ($settings as &$item) {
            foreach ($item as &$subitem) {
                // handle MEDIA type
                if (isset($subitem['id'], $subitem['url'])) {
                    $subitem['url'] = Helper::getMediaLink($subitem['url'], true);
                }
            }
        }

        return $settings;
    }

    public function getValue($control, $instance)
    {
        $value = parent::getValue($control, $instance);

        if (!empty($value)) {
            foreach ($value as &$item) {
                foreach ($control['fields'] as $field) {
                    $control_obj = Plugin::instance()->controls_manager->getControl($field['type']);
                    if (!$control_obj) {
                        continue;
                    }

                    $item[$field['name']] = $control_obj->getValue($field, $item);
                }
            }
        }
        return $value;
    }

    public function contentTemplate()
    {
        ?>
        <label>
            <span class="elementor-control-title">{{{ data.label }}}</span>
        </label>
        <div class="elementor-repeater-fields"></div>
        <div class="elementor-button-wrapper">
            <button class="elementor-button elementor-button-default elementor-repeater-add"><span class="eicon-plus"></span><?php _e('Add Item', 'elementor');?></button>
        </div>
        <?php
    }
}
