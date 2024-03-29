<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

require_once _PS_MODULE_DIR_ . 'novelementor/includes/helper.php';

/**
 * Main class plugin
 */
class Plugin
{
    /**
     * @var Plugin
     */
    private static $_instance = null;

    /**
     * @var ControlsManager
     */
    public $controls_manager;

    /**
     * @var SchemesManager
     */
    public $schemes_manager;

    /**
     * @var ElementsManager
     */
    public $elements_manager;

    /**
     * @var WidgetsManager
     */
    public $widgets_manager;

    /**
     * @var Frontend
     */
    public $frontend;

    /**
     * @var SkinsManager
     */
    public $skins_manager;

    /**
     * @var PostsCssManager
     */
    public $posts_css_manager;

    private function __construct()
    {
        $this->_includes();

        $this->db = new DB();
        $this->controls_manager = new ControlsManager();
        $this->schemes_manager = new SchemesManager();
        $this->elements_manager = new ElementsManager();
        $this->widgets_manager = new WidgetsManager();
        $this->skins_manager = new SkinsManager();
        $this->posts_css_manager = new PostsCssManager();
        $this->editor = new Editor();
        $this->frontend = new Frontend();
        $this->templates_manager = new TemplateLibrary\Manager();
    }

    /**
     * Throw error on object clone
     *
     * The whole idea of the singleton design pattern is that there is a single
     * object therefore, we don't want the object to be cloned.
     *
     * @since 1.0.0
     * @return void
     */
    public function __clone()
    {
        // Cloning instances of the class is forbidden
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'elementor'), '1.0.0');
    }

    /**
     * Disable unserializing of the class
     *
     * @since 1.0.0
     * @return void
     */
    public function __wakeup()
    {
        // Unserializing instances of the class is forbidden
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'elementor'), '1.0.0');
    }

    /**
     * @return Plugin
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getCurrentIntroduction()
    {
        return array(
            'active' => true,
            'title' => '<div id="elementor-introduction-title">' . __('Two Minute Tour Of Elementor', 'elementor') . '</div>' .
                '<div id="elementor-introduction-subtitle">' . __('Watch this quick tour that gives you a basic understanding of how to use Elementor.', 'elementor') . '</div>',
            'content' => '<div class="elementor-video-wrapper"><iframe src="https://www.youtube.com/embed/6u45V2q1s4k?autoplay=1&rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe></div>',
            'delay' => 2500,
            'version' => 1,
        );
    }

    public function getVersion()
    {
        $this->frontend->printCss();

        return '1.0.0';
    }

    private function _includes()
    {
        include _PS_MODULE_DIR_ . 'novelementor/includes/api.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/utils.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/fonts.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/db.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/managers/controls.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/managers/schemes.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/managers/elements.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/managers/widgets.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/managers/skins.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/settings/settings.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/editor.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/frontend.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/responsive.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/stylesheet.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/template-library/manager.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/managers/posts-css.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/posts-css/post-css-file.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/conditions.php';
    }
}
