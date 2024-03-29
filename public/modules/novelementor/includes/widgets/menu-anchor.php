<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetMenuAnchor extends WidgetBase
{
    public function getName()
    {
        return 'menu-anchor';
    }

    public function getTitle()
    {
        return __('Menu Anchor', 'elementor');
    }

    public function getIcon()
    {
        return 'anchor';
    }

    public function getCategories()
    {
        return array('general-elements');
    }

    protected function _registerControls()
    {
        $this->startControlsSection(
            'section_anchor',
            array(
                'label' => __('Anchor', 'elementor'),
            )
        );

        $this->addControl(
            'anchor_description',
            array(
                'raw' => __('This ID will be the CSS ID you will have to use in your own page, Without #.', 'elementor'),
                'type' => ControlsManager::RAW_HTML,
                'classes' => 'elementor-descriptor',
            )
        );

        $this->addControl(
            'anchor',
            array(
                'label' => __('The ID of Menu Anchor.', 'elementor'),
                'type' => ControlsManager::TEXT,
                'placeholder' => __('For Example: About', 'elementor'),
                'label_block' => true,
            )
        );

        $this->endControlsSection();
    }

    protected function render()
    {
        $anchor = $this->getSettings('anchor');

        if (!empty($anchor)) {
            $this->addRenderAttribute('inner', 'id', $anchor);
        }

        $this->addRenderAttribute('inner', 'class', 'elementor-menu-anchor');
        ?>
        <div <?php echo $this->getRenderAttributeString('inner'); ?>></div>
        <?php
    }

    protected function _contentTemplate()
    {
        ?>
        <div class="elementor-menu-anchor"{{{ settings.anchor ? ' id="' + settings.anchor + '"' : '' }}}></div>
        <?php
    }
}
