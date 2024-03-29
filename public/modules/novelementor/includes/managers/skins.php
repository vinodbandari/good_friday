<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class SkinsManager
{
    private $_skins = array();

    public function addSkin(WidgetBase $widget, Skin_Base $skin)
    {
        $widget_name = $widget->getName();

        if (!isset($this->_skins[$widget_name])) {
            $this->_skins[$widget_name] = array();
        }

        $this->_skins[$widget_name][$skin->getId()] = $skin;

        return true;
    }

    public function removeSkin(WidgetBase $widget, $skin_id)
    {
        $widget_name = $widget->getName();

        if (!isset($this->_skins[$widget_name][$skin_id])) {
            return new \PrestaShopException('Cannot remove not-exists skin.');
        }

        unset($this->_skins[$widget_name][$skin_id]);

        return true;
    }

    public function getSkins(WidgetBase $widget)
    {
        $widget_name = $widget->getName();

        if (!isset($this->_skins[$widget_name])) {
            return false;
        }

        return $this->_skins[$widget_name];
    }

    public function __construct()
    {
        require _PS_MODULE_DIR_ . 'novelementor/includes/base/skin-base.php';
    }
}
