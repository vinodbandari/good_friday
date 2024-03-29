<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

abstract class SchemeBase implements SchemeInterface
{
    private $_system_schemes;

    abstract protected function _initSystemSchemes();

    public static function getDescription()
    {
        return '';
    }

    final public function getSystemSchemes()
    {
        if (null === $this->_system_schemes) {
            $this->_system_schemes = $this->_initSystemSchemes();
        }

        return $this->_system_schemes;
    }

    public function getSchemeValue()
    {
        $scheme_value = get_option('elementor_scheme_' . static::getType());

        if (!$scheme_value) {
            $scheme_value = $this->getDefaultScheme();

            update_option('elementor_scheme_' . static::getType(), $scheme_value);
        }

        return $scheme_value;
    }

    public function saveScheme(array $posted)
    {
        $scheme_value = $this->getSchemeValue();

        update_option('elementor_scheme_' . static::getType(), array_replace($scheme_value, array_intersect_key($posted, $scheme_value)));
    }

    public function getScheme()
    {
        $scheme = array();

        $titles = $this->getSchemeTitles();

        foreach ($this->getSchemeValue() as $scheme_key => $scheme_value) {
            $scheme[$scheme_key] = array(
                'title' => isset($titles[$scheme_key]) ? $titles[$scheme_key] : '',
                'value' => $scheme_value,
            );
        }

        return $scheme;
    }

    final public function printTemplate()
    {
        ?>
        <script type="text/template" id="tmpl-elementor-panel-schemes-<?php echo static::getType(); ?>">
            <div class="elementor-panel-scheme-buttons">
                <div class="elementor-panel-scheme-button-wrapper elementor-panel-scheme-reset">
                    <button class="elementor-button">
                        <i class="fa fa-undo"></i>
                        <?php _e('Reset', 'elementor');?>
                    </button>
                </div>
                <div class="elementor-panel-scheme-button-wrapper elementor-panel-scheme-discard">
                    <button class="elementor-button">
                        <i class="fa fa-times"></i>
                        <?php _e('Discard', 'elementor');?>
                    </button>
                </div>
                <div class="elementor-panel-scheme-button-wrapper elementor-panel-scheme-save">
                    <button class="elementor-button elementor-button-success" disabled><?php _e('Apply', 'elementor');?></button>
                </div>
            </div>
            <?php $this->printTemplateContent();?>
        </script>
        <?php
    }
}
