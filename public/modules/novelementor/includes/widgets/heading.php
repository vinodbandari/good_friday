<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetHeading extends WidgetBase
{
    public function getName()
    {
        return 'heading';
    }

    public function getTitle()
    {
        return __('Heading', 'elementor');
    }

    public function getIcon()
    {
        return 'type-tool';
    }

    protected function _registerControls()
    {
        $this->startControlsSection(
            'section_title',
            array(
                'label' => __('Title', 'elementor'),
            )
        );

        $this->addControl(
            'title',
            array(
                'label' => __('Title', 'elementor'),
                'type' => ControlsManager::TEXTAREA,
                'placeholder' => __('Enter your title', 'elementor'),
                'default' => __('This is heading element', 'elementor'),
            )
        );

        $this->addControl(
            'link',
            array(
                'label' => __('Link', 'elementor'),
                'type' => ControlsManager::URL,
                'placeholder' => 'http://your-link.com',
                'default' => array(
                    'url' => '',
                ),
                'separator' => 'before',
            )
        );

        $this->addControl(
            'size',
            array(
                'label' => __('Size', 'elementor'),
                'type' => ControlsManager::SELECT,
                'default' => 'default',
                'options' => array(
                    'default' => __('Default', 'elementor'),
                    'small' => __('Small', 'elementor'),
                    'medium' => __('Medium', 'elementor'),
                    'large' => __('Large', 'elementor'),
                    'xl' => __('XL', 'elementor'),
                    'xxl' => __('XXL', 'elementor'),
                ),
            )
        );

        $this->addControl(
            'header_size',
            array(
                'label' => __('HTML Tag', 'elementor'),
                'type' => ControlsManager::SELECT,
                'options' => array(
                    'h1' => __('H1', 'elementor'),
                    'h2' => __('H2', 'elementor'),
                    'h3' => __('H3', 'elementor'),
                    'h4' => __('H4', 'elementor'),
                    'h5' => __('H5', 'elementor'),
                    'h6' => __('H6', 'elementor'),
                    'div' => __('div', 'elementor'),
                    'span' => __('span', 'elementor'),
                    'p' => __('p', 'elementor'),
                ),
                'default' => 'h2',
            )
        );

        $this->addResponsiveControl(
            'align',
            array(
                'label' => __('Alignment', 'elementor'),
                'type' => ControlsManager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left', 'elementor'),
                        'icon' => 'align-left',
                    ),
                    'center' => array(
                        'title' => __('Center', 'elementor'),
                        'icon' => 'align-center',
                    ),
                    'right' => array(
                        'title' => __('Right', 'elementor'),
                        'icon' => 'align-right',
                    ),
                    'justify' => array(
                        'title' => __('Justified', 'elementor'),
                        'icon' => 'align-justify',
                    ),
                ),
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->addControl(
            'view',
            array(
                'label' => __('View', 'elementor'),
                'type' => ControlsManager::HIDDEN,
                'default' => 'traditional',
            )
        );

        $this->endControlsSection();

        $this->startControlsSection(
            'section_title_style',
            array(
                'label' => __('Title', 'elementor'),
                'tab' => ControlsManager::TAB_STYLE,
            )
        );

        $this->addControl(
            'title_color',
            array(
                'label' => __('Text Color', 'elementor'),
                'type' => ControlsManager::COLOR,
                'scheme' => array(
                    'type' => SchemeColor::getType(),
                    'value' => SchemeColor::COLOR_1,
                ),
                'selectors' => array(
                    '{{WRAPPER}} .elementor-heading-title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->addGroupControl(
            GroupControlTypography::getType(),
            array(
                'name' => 'typography',
                'scheme' => SchemeTypography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            )
        );

        $this->endControlsSection();
    }

    protected function render()
    {
        $settings = $this->getSettings();

        if (empty($settings['title'])) {
            return;
        }

        $this->addRenderAttribute('heading', 'class', 'elementor-heading-title');

        if (!empty($settings['size'])) {
            $this->addRenderAttribute('heading', 'class', 'elementor-size-' . $settings['size']);
        }

        if (!empty($settings['link']['url'])) {
            $url = sprintf('<a href="%s">%s</a>', $settings['link']['url'], $settings['title']);
            $title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->getRenderAttributeString('heading'), $url);
        } else {
            $title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->getRenderAttributeString('heading'), '<span>' . $settings['title'] . '</span>');
        }

        echo $title_html;
    }

    protected function _contentTemplate()
    {
        ?>
        <#
        if ( '' !== settings.title ) {
            var title_html = '<' + settings.header_size  + ' class="elementor-heading-title elementor-size-' + settings.size + '"><span>' + settings.title + '</span></' + settings.header_size + '>';
        }

        if ( '' !== settings.link.url ) {
            var title_html = '<' + settings.header_size  + ' class="elementor-heading-title elementor-size-' + settings.size + '"><a href="' + settings.link.url + '"><span>' + title_html + '</span></a></' + settings.header_size + '>';
        }

        print( title_html );
        #>
        <?php
    }
}
