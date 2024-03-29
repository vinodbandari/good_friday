<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetsManager
{
    /**
     * @var WidgetBase[]
     */
    private $_widget_types = null;

    private function _initWidgets()
    {
        $build_widgets_filename = array(
            'common',
            'heading',
            'image',
            'text-editor',
            'video',
            'button',
            'divider',
            'spacer',
            'google-maps',
            'icon',
            'facebook-page',
            'image-box',
            'icon-box',
            'flip-box',
            'call-to-action',
            'image-carousel',
            'image-hotspot',
            'icon-list',
            'counter',
            'progress',
            'testimonial',
            'tabs',
            'accordion',
            'toggle',
            'social-icons',
            'alert',
            'html',
            'menu-anchor',
            // PS
            'ajax-search',
            //'login',
            'trustedshops-reviews',
            'product-grid',
        );

        // skip following widgets on PS 1.6.x
        if (version_compare(_PS_VERSION_, '1.7', '>=')) {
            $build_widgets_filename[] = 'product-carousel';
            $build_widgets_filename[] = 'image-slider';
            $build_widgets_filename[] = 'email-subscription';
            $build_widgets_filename[] = 'category-tree';
            $build_widgets_filename[] = 'nov-product-list';
            $build_widgets_filename[] = 'nov-product-list-2';
            $build_widgets_filename[] = 'nov-product-tabs';
            $build_widgets_filename[] = 'nov-product-tabs-category';
            $build_widgets_filename[] = 'nov-product-deal';
            $build_widgets_filename[] = 'nov-product-top-trending';
            $build_widgets_filename[] = 'nov-product-video';
            $build_widgets_filename[] = 'nov-manufacture';
            $build_widgets_filename[] = 'nov-blog-list';
            $build_widgets_filename[] = 'nov-testimonials';
            $build_widgets_filename[] = 'nov-slider-text';
            $build_widgets_filename[] = 'nov-nivo-slider';
            $build_widgets_filename[] = 'nov-google-maps';
            $build_widgets_filename[] = 'nov-contact-form';
            $build_widgets_filename[] = 'nov-image-gallery';
            $build_widgets_filename[] = 'nov-instagram';
            $build_widgets_filename[] = 'nov-lookbook';
            $build_widgets_filename[] = 'nov-banner';
            $build_widgets_filename[] = 'nov-banner-2';
            $build_widgets_filename[] = 'nov-banner-img';
            $build_widgets_filename[] = 'nov-banner-img-2';
            $build_widgets_filename[] = 'nov-banner-product';
            $build_widgets_filename[] = 'nov-banner-slider';
            $build_widgets_filename[] = 'nov-policy';
            $build_widgets_filename[] = 'nov-banner-video';
            $build_widgets_filename[] = 'nov-video';
            $build_widgets_filename[] = 'nov-video-2';
        }

        $this->_widget_types = array();

        foreach ($build_widgets_filename as $widget_filename) {
            include _PS_MODULE_DIR_ . 'novelementor/includes/widgets/' . $widget_filename . '.php';

            $class_name = __NAMESPACE__ . '\Widget' . str_replace('-', '', $widget_filename);

            $this->registerWidgetType(new $class_name());
        }

        $this->_registerPsWidgets();

        // $this->_registerVinovaWidgets();
    }

    private function _registerPsWidgets()
    {
        include _PS_MODULE_DIR_ . 'novelementor/includes/widgets/prestashop.php';

        $widgets = glob(_PS_MODULE_DIR_ . 'novelementor/classes/widgets/NovElementorWidget*.php');

        foreach ($widgets as $widget_file) {
            include $widget_file;

            $elementor_widget_class = __NAMESPACE__ . '\WidgetPrestaShop';
            $widget_class = basename($widget_file, '.php');

            // skip Module widget on PS 1.6.x
            if ($widget_class == 'NovElementorWidgetModule' && version_compare(_PS_VERSION_, '1.7', '<')) {
                continue;
            }

            if (!property_exists($widget_class, 'require') || ($req = new \ReflectionProperty($widget_class, 'require')) && \Module::isEnabled($req->getValue())) {
                $widget = new $elementor_widget_class(array(), array(
                    'widget_name' => $widget_class,
                ));

                $this->registerWidgetType($widget);
            }
        }
    }

    private function _registerVinovaWidgets()
    {
        include _PS_MODULE_DIR_ . 'novelementor/includes/widgets/vinova.php';

        $widgets = glob(_PS_MODULE_DIR_ . 'novelementor/classes/widgets/VinovaWidget*.php');
        foreach ($widgets as $widget_file) {
            include $widget_file;

            $elementor_widget_class = __NAMESPACE__ . '\WidgetVinova';
            $widget_class = basename($widget_file, '.php');

            // skip Module widget on PS 1.6.x
            if ($widget_class == 'VinovaWidgetModule' && version_compare(_PS_VERSION_, '1.7', '<')) {
                continue;
            }

            if (!property_exists($widget_class, 'require') || ($req = new \ReflectionProperty($widget_class, 'require')) && \Module::isEnabled($req->getValue())) {
                $widget = new $elementor_widget_class(array(), array(
                    'widget_name' => $widget_class,
                ));

                $this->registerWidgetType($widget);
            }
        }
    }

    private function _requireFiles()
    {
        require_once _PS_MODULE_DIR_ . 'novelementor/includes/base/element-base.php';
        require _PS_MODULE_DIR_ . 'novelementor/includes/base/widget-base.php';
    }

    public function registerWidgetType(WidgetBase $widget)
    {
        if (is_null($this->_widget_types)) {
            $this->_initWidgets();
        }

        $this->_widget_types[$widget->getName()] = $widget;

        return true;
    }

    public function unregisterWidgetType($name)
    {
        if (!isset($this->_widget_types[$name])) {
            return false;
        }

        unset($this->_widget_types[$name]);

        return true;
    }

    public function getWidgetTypes($widget_name = null)
    {
        if (is_null($this->_widget_types)) {
            $this->_initWidgets();
        }

        if (null !== $widget_name) {
            return isset($this->_widget_types[$widget_name]) ? $this->_widget_types[$widget_name] : null;
        }

        return $this->_widget_types;
    }

    public function getWidgetTypesConfig()
    {
        $config = array();

        foreach ($this->getWidgetTypes() as $widget_key => $widget) {
            if ('common' === $widget_key) {
                continue;
            }

            $config[$widget_key] = $widget->getConfig();
        }

        return $config;
    }

    public function ajaxRenderWidget()
    {
        $data = empty(${'_POST'}['data']) ? '' : ${'_POST'}['data'];
        $data = json_decode(html_entity_decode($data), true);
        $render_html = 'Missing widget: ' . $data['widgetType'];

        // Start buffering
        ob_start();

        /** @var WidgetBase|WidgetPrestaShop $widget_type */
        $widget_type = $this->getWidgetTypes($data['widgetType']);

        if ($widget_type) {
            $widget_class = $widget_type->getClassName();

            /** @var WidgetBase $widget */
            $widget = new $widget_class($data, $widget_type->getDefaultArgs());

            $widget->renderContent();

            $render_html = ob_get_clean();
        }

        wp_send_json_success(array(
            'render' => $render_html,
        ));
    }

    public function renderWidgetsContent()
    {
        foreach ($this->getWidgetTypes() as $widget) {
            $widget->printTemplate();
        }
    }

    public function __construct()
    {
        $this->_requireFiles();
    }
}
