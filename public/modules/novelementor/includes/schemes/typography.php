<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class SchemeTypography extends SchemeBase
{
    const TYPOGRAPHY_1 = '1';
    const TYPOGRAPHY_2 = '2';
    const TYPOGRAPHY_3 = '3';
    const TYPOGRAPHY_4 = '4';

    public static function getType()
    {
        return 'typography';
    }

    public function getTitle()
    {
        return __('Typography', 'elementor');
    }

    public function getDisabledTitle()
    {
        return __('Default Fonts', 'elementor');
    }

    public function getSchemeTitles()
    {
        return array(
            self::TYPOGRAPHY_1 => __('Primary Headline', 'elementor'),
            self::TYPOGRAPHY_2 => __('Secondary Headline', 'elementor'),
            self::TYPOGRAPHY_3 => __('Body Text', 'elementor'),
            self::TYPOGRAPHY_4 => __('Accent Text', 'elementor'),
        );
    }

    public function getDefaultScheme()
    {
        return array(
            self::TYPOGRAPHY_1 => array(
                'font_family' => 'Montserrat',
                'font_weight' => '600',
            ),
            self::TYPOGRAPHY_2 => array(
                'font_family' => 'Montserrat',
                'font_weight' => '400',
            ),
            self::TYPOGRAPHY_3 => array(
                'font_family' => 'Montserrat',
                'font_weight' => '400',
            ),
            self::TYPOGRAPHY_4 => array(
                'font_family' => 'Montserrat',
                'font_weight' => '500',
            ),
        );
    }

    protected function _initSystemSchemes()
    {
        return array();
    }

    public function printTemplateContent()
    {
        ?>
        <div class="elementor-panel-scheme-items"></div>
        <?php
    }
}
