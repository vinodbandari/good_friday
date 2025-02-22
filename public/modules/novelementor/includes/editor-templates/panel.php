<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;
?>
<script type="text/template" id="tmpl-elementor-panel">
    <div id="elementor-mode-switcher"></div>
    <header id="elementor-panel-header-wrapper"></header>
    <main id="elementor-panel-content-wrapper"></main>
    <footer id="elementor-panel-footer">
        <div class="elementor-panel-container">
        </div>
    </footer>
</script>

<script type="text/template" id="tmpl-elementor-panel-menu-item">
    <div class="elementor-panel-menu-item-icon">
        <i class="fa fa-{{ icon }}"></i>
    </div>
    <div class="elementor-panel-menu-item-title">{{{ title }}}</div>
</script>

<script type="text/template" id="tmpl-elementor-panel-header">
    <div id="elementor-panel-header-menu-button" class="elementor-header-button">
        <i class="elementor-icon eicon-menu tooltip-target" data-tooltip="<?php esc_attr_e('Menu', 'elementor');?>"></i>
    </div>
    <div id="elementor-panel-header-title"></div>
    <div id="elementor-panel-header-add-button" class="elementor-header-button">
        <i class="elementor-icon eicon-apps tooltip-target" data-tooltip="<?php esc_attr_e('Widgets Panel', 'elementor');?>"></i>
    </div>
</script>

<script type="text/template" id="tmpl-elementor-panel-footer-content">
    <div id="elementor-panel-footer-exit" class="elementor-panel-footer-tool" title="<?php _e('Exit', 'elementor');?>">
        <i class="fa fa-times"></i>
        <div class="elementor-panel-footer-sub-menu-wrapper">
            <div class="elementor-panel-footer-sub-menu">
                <a id="elementor-panel-footer-view-page" class="elementor-panel-footer-sub-menu-item" href="javascript:void window.open(ElementorConfig.post_permalink)">
                    <i class="elementor-icon fa fa-external-link"></i>
                    <span class="elementor-title"><?php _e('View Page', 'elementor');?></span>
                </a>
                <a id="elementor-panel-footer-view-edit-page" class="elementor-panel-footer-sub-menu-item" href="javascript:void(location.href=ElementorConfig.edit_post_link)">
                    <i class="elementor-icon fa fa-arrow-left"></i>
                    <span class="elementor-title"><?php _e('Go to Back-office', 'elementor');?></span>
                </a>
            </div>
        </div>
    </div>
    <div id="elementor-panel-footer-responsive" class="elementor-panel-footer-tool" title="<?php esc_attr_e('Responsive Mode', 'elementor');?>">
        <i class="eicon-device-desktop"></i>
        <div class="elementor-panel-footer-sub-menu-wrapper">
            <div class="elementor-panel-footer-sub-menu">
                <div class="elementor-panel-footer-sub-menu-item" data-device-mode="desktop">
                    <i class="elementor-icon eicon-device-desktop"></i>
                    <span class="elementor-title"><?php _e('Desktop', 'elementor');?></span>
                    <span class="elementor-description"><?php _e('Default Preview', 'elementor');?></span>
                </div>
                <div class="elementor-panel-footer-sub-menu-item" data-device-mode="tablet">
                    <i class="elementor-icon eicon-device-tablet"></i>
                    <span class="elementor-title"><?php _e('Tablet', 'elementor');?></span>
                    <span class="elementor-description"><?php _e('Preview for 768px', 'elementor');?></span>
                </div>
                <div class="elementor-panel-footer-sub-menu-item" data-device-mode="mobile">
                    <i class="elementor-icon eicon-device-mobile"></i>
                    <span class="elementor-title"><?php _e('Mobile', 'elementor');?></span>
                    <span class="elementor-description"><?php _e('Preview for 360px', 'elementor');?></span>
                </div>
            </div>
        </div>
    </div>
    <div id="elementor-panel-footer-help" class="elementor-panel-footer-tool" title="<?php esc_attr_e('Help', 'elementor');?>">
        <span class="elementor-screen-only"><?php _e('Help', 'elementor');?></span>
        <i class="fa fa-question-circle"></i>
        <div class="elementor-panel-footer-sub-menu-wrapper">
            <div class="elementor-panel-footer-sub-menu">
                <div id="elementor-panel-footer-help-title"><?php _e('Need help?', 'elementor');?></div>
                <div id="elementor-panel-footer-watch-tutorial" class="elementor-panel-footer-sub-menu-item">
                    <i class="elementor-icon fa fa-video-camera"></i>
                    <span class="elementor-title"><?php _e('Take a tour', 'elementor');?></span>
                </div>
                <div class="elementor-panel-footer-sub-menu-item">
                    <i class="elementor-icon fa fa-external-link"></i>
                    <a class="elementor-title" href="#" target="_blank"><?php _e('Go to the Documentation', 'elementor');?></a>
                </div>
            </div>
        </div>
    </div>
    <div id="elementor-panel-footer-templates" class="elementor-panel-footer-tool" title="<?php esc_attr_e('Templates', 'elementor');?>">
        <span class="elementor-screen-only"><?php _e('Templates', 'elementor');?></span>
        <i class="fa fa-folder"></i>
        <div class="elementor-panel-footer-sub-menu-wrapper">
            <div class="elementor-panel-footer-sub-menu">
                <div id="elementor-panel-footer-templates-modal" class="elementor-panel-footer-sub-menu-item">
                    <i class="elementor-icon fa fa-folder"></i>
                    <span class="elementor-title"><?php _e('Templates Library', 'elementor');?></span>
                </div>
                <div id="elementor-panel-footer-save-template" class="elementor-panel-footer-sub-menu-item">
                    <i class="elementor-icon fa fa-save"></i>
                    <span class="elementor-title"><?php _e('Save Template', 'elementor');?></span>
                </div>
            </div>
        </div>
    </div>
    <div id="elementor-panel-footer-save" class="elementor-panel-footer-tool" title="<?php esc_attr_e('Save', 'elementor');?>">
        <button class="elementor-button">
            <span class="elementor-state-icon">
                <i class="fa fa-spin fa-circle-o-notch "></i>
            </span>
            <?php _e('Save', 'elementor');?>
        </button>
    </div>
</script>

<script type="text/template" id="tmpl-elementor-mode-switcher-content">
    <input id="elementor-mode-switcher-preview-input" type="checkbox">
    <label for="elementor-mode-switcher-preview-input" id="elementor-mode-switcher-preview" title="<?php esc_attr_e('Preview', 'elementor');?>">
        <span class="elementor-screen-only"><?php _e('Preview', 'elementor');?></span>
        <i class="fa"></i>
    </label>
</script>

<script type="text/template" id="tmpl-editor-content">
    <div class="elementor-tabs-controls">
        <ul>
            <# _.each( elementData.tabs_controls, function( tabTitle, tabSlug ) { #>
            <li class="elementor-tab-control-{{ tabSlug }}">
                <a href="#" data-tab="{{ tabSlug }}">
                    {{{ tabTitle }}}
                </a>
            </li>
            <# } ); #>
        </ul>
    </div>
    <# if ( elementData.reload_preview ) { #>
        <div id="elementor-update-preview">
            <div id="elementor-update-preview-title"><?php echo __('Update changes to page', 'elementor'); ?></div>
            <div id="elementor-update-preview-button-wrapper">
                <button id="elementor-update-preview-button" class="elementor-button elementor-button-success"><?php echo __('Apply', 'elementor'); ?></button>
            </div>
        </div>
    <# } #>
    <div id="elementor-controls"></div>
</script>

<script type="text/template" id="tmpl-elementor-panel-schemes-disabled">
    <i class="eicon-nerd"></i>
    <div id="elementor-panel-schemes-disabled-title">{{{ '<?php echo __('{0} are disabled', 'elementor'); ?>'.replace( '{0}', disabledTitle ) }}}</div>
    <div id="elementor-panel-schemes-disabled-content"><?php printf(__('You can enable it from the <a href="%s" target="_blank">Elementor settings page</a>.', 'elementor'), Settings::getUrl());?></div>
</script>

<script type="text/template" id="tmpl-elementor-panel-scheme-color-item">
    <div class="elementor-panel-scheme-color-input-wrapper">
        <input type="text" class="elementor-panel-scheme-color-value" value="{{ value }}" data-alpha="true" />
    </div>
    <div class="elementor-panel-scheme-color-title">{{{ title }}}</div>
</script>

<script type="text/template" id="tmpl-elementor-panel-scheme-typography-item">
    <div class="elementor-panel-heading">
        <div class="elementor-panel-heading-toggle">
            <i class="fa"></i>
        </div>
        <div class="elementor-panel-heading-title">{{{ title }}}</div>
    </div>
    <div class="elementor-panel-scheme-typography-items elementor-panel-box-content">
        <?php
        $scheme_fields_keys = GroupControlTypography::getSchemeFieldsKeys();
        $typography_fields = GroupControlTypography::getFields();
        $scheme_fields = array_intersect_key($typography_fields, array_flip($scheme_fields_keys));
        ?>
        <?php foreach ($scheme_fields as $option_name => $option) : ?>
            <div class="elementor-panel-scheme-typography-item">
                <div class="elementor-panel-scheme-item-title elementor-control-title"><?php echo $option['label']; ?></div>
                <div class="elementor-panel-scheme-typography-item-value">
                    <?php if ('select' === $option['type']) : ?>
                        <select name="<?php echo $option_name; ?>" class="elementor-panel-scheme-typography-item-field">
                            <?php foreach ($option['options'] as $field_key => $field_value) : ?>
                                <option value="<?php echo $field_key; ?>"><?php echo $field_value; ?></option>
                            <?php endforeach;?>
                        </select>
                    <?php elseif ('font' === $option['type']) : ?>
                        <select name="<?php echo $option_name; ?>" class="elementor-panel-scheme-typography-item-field">
                            <option value=""><?php _e('Default', 'elementor');?></option>

                            <optgroup label="<?php _e('System', 'elementor');?>">
                                <?php foreach (Fonts::getFontsByGroups(array(Fonts::SYSTEM)) as $font_title => $font_type) : ?>
                                    <option value="<?php echo esc_attr($font_title); ?>"><?php echo $font_title; ?></option>
                                <?php endforeach;?>
                            </optgroup>

                            <optgroup label="<?php _e('Google', 'elementor');?>">
                                <?php foreach (Fonts::getFontsByGroups(array(Fonts::GOOGLE, Fonts::EARLYACCESS)) as $font_title => $font_type) : ?>
                                    <option value="<?php echo esc_attr($font_title); ?>"><?php echo $font_title; ?></option>
                                <?php endforeach;?>
                            </optgroup>
                        </select>
                    <?php elseif ('text' === $option['type']) : ?>
                        <input name="<?php echo $option_name; ?>" class="elementor-panel-scheme-typography-item-field" />
                    <?php endif;?>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</script>

<script type="text/template" id="tmpl-elementor-control-responsive-switchers">
    <div class="elementor-control-responsive-switchers">
        <a class="elementor-responsive-switcher elementor-responsive-switcher-desktop" data-device="desktop">
            <i class="eicon-device-desktop"></i>
        </a>
        <a class="elementor-responsive-switcher elementor-responsive-switcher-tablet" data-device="tablet">
            <i class="eicon-device-tablet"></i>
        </a>
        <a class="elementor-responsive-switcher elementor-responsive-switcher-mobile" data-device="mobile">
            <i class="eicon-device-mobile"></i>
        </a>
    </div>
</script>
