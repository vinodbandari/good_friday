<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovBlogList extends WidgetBase {

    public function getName() {
        return 'nov-blog-list';
    }

    public function getTitle() {
        return __('Nov Blog List', 'elementor');
    }

    public function getIcon() {
        return 'vinova-icon';
    }

    public function getCategories() {
        return array('vinova');
    }

    protected function _getCategoriesBlog() {
        $opts = array();

        $array_cats = \NovElementor::getCategoriesBlog();
        if ($array_cats) {
            foreach ($array_cats as $root_cat) {
                $opts[' ' . $root_cat['id_smart_blog_category']] = $root_cat['name'];
                if (!empty($root_cat['children'])) {
                    foreach ($root_cat['children'] as $cat) {
                        $opts[' ' . $cat['id_smart_blog_category']] = '&nbsp;' . $cat['name'];
                        if (!empty($cat['children'])) {
                            foreach ($cat['children'] as $cat2) {
                                $opts[' ' . $cat2['id_smart_blog_category']] = '&nbsp;&nbsp;' . $cat2['name'];
                                if (!empty($cat2['children'])) {
                                    foreach ($cat2['children'] as $cat3) {
                                        $opts[' ' . $cat3['id_smart_blog_category']] = '&nbsp;&nbsp;&nbsp;' . $cat3['name'];
                                        if (!empty($cat3['children'])) {
                                            foreach ($cat3['children'] as $cat4) {
                                                $opts[' ' . $cat4['id_smart_blog_category']] = '&nbsp;&nbsp;&nbsp;&nbsp;' . $cat4['name'];
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $opts;
    }

    protected function _registerControls() {
        $this->startControlsSection(
                'section_bloglist_settings', array(
            'label' => __('Nov Blog List Settings', 'elementor'),
                )
        );

        $this->addControl(
                'title', array(
            'label' => __('Title', 'elementor'),
            'type' => ControlsManager::TEXT,
            'default' => ''
                )
        );

        $this->addControl(
                'sub_title', array(
            'label' => __('Sub Title', 'elementor'),
            'type' => ControlsManager::TEXT,
            'default' => ''
                )
        );
        $this->addControl(
                'button', array(
            'name' => "button",
            'label' => __('Button', 'elementor'),
            'type' => ControlsManager::TEXT,
            'label_block' => true,
            'default' => '',
            'condition' => array(
                'display_type' => 'slider-type-3'
            )   
                )
        );
        $this->addControl(
                'link', array(
            'label' => __('Link button', 'elementor'),
            'type' => ControlsManager::URL,
            'placeholder' => 'http://your-link.com',
            'default' => array(
                'url' => '#',
            ),
            'condition' => array(
                'display_type' => 'slider-type-3'
            )   
                )
        );
        $this->addControl(
                'title_align', array(
            'label' => __('Title Align', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'left',
            'options' => array(
                'left' => __('Left', 'elementor'),
                'center' => __('Center', 'elementor'),
                'right' => __('Right', 'elementor'),
            )
                )
        );


        $this->addControl(
                'categories', array(
            'label' => __('Category ID', 'elementor'),
            'type' => ControlsManager::SELECT2,
            'multiple' => true,
            'options' => $this->_getCategoriesBlog()
                )
        );

        $this->addControl(
                'limit', array(
            'label' => __('Limit', 'elementor'),
            'type' => ControlsManager::NUMBER,
            'default' => 12
                )
        );

        $this->addControl(
                'orderby', array(
            'label' => __('Order By', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'p.id_smart_blog_post',
            'options' => array(
                'created' => __('Date', 'elementor'),
                'p.id_smart_blog_post' => __('ID', 'elementor'),
                'meta_title' => __('Title', 'elementor'),
                'modified' => __('Modified', 'elementor'),
                'position' => __('Position', 'elementor'),
                'link_rewrite' => __('Slug', 'elementor'),
            )
                )
        );

        $this->addControl(
                'order', array(
            'label' => __('Order Direction', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'DESC',
            'options' => array(
                'ASC' => __('Ascending', 'elementor'),
                'DESC' => __('Descending', 'elementor'),
            )
                )
        );

        $this->addControl(
                'display_type', array(
            'label' => __('Display Style', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'slider-type-1',
            'options' => array(
                'slider-type-1' => __('Slider Stype 1', 'elementor'),
                'slider-type-2' => __('Slider Stype 2', 'elementor'),
                'slider-type-3' => __('Slider Stype 3', 'elementor')
            )
                )
        );

        $this->addControl(
                'number_row', array(
            'label' => __('Number Row', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => '1',
            'options' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3'
            ),
            'condition' => array(
                'display_type' => array('slider-type-1', 'slider-type-2'),
            ),
                )
        );

        $this->addControl(
                'show_arrows', array(
            'label' => __('Show Arrows', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
            'condition' => array(
                'display_type' => array( 'slider-type-2'),
            ),
                )
        );

        $this->addControl(
                'show_dots', array(
            'label' => __('Show Dots', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
            'condition' => array(
                'display_type' => array('slider-type-2'),
            ),
                )
        );

        $this->addControl(
                'autoplay', array(
            'label' => __('Autoplay', 'elementor'),
            'type' => ControlsManager::CHECKBOX,
            'default' => false,
            'condition' => array(
                'display_type' => array('slider-type-1', 'slider-type-2', 'slider-type-3', 'slider-type-4', 'slider-type-5', 'slider-type-6'),
            ),
                )
        );

        $slides_to_show = range(1, 12);
        $slides_to_show = array_combine($slides_to_show, $slides_to_show);

        $this->addResponsiveControl(
                'columns', array(
            'label' => __('Slides to Show', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 4,
            'options' => array(4 => __('4', 'elementor')) + $slides_to_show,
                )
        );

        $this->endControlsSection();
    }

    public function getControls($control_id = null) {
        $controls = parent::getControls($control_id);

        if (_THEME_NAME_ == 'classic') {
            if (isset($controls['_margin'])) {
                $controls['_margin']['default'] = array(
                    'top' => '0',
                    'right' => '-10',
                    'bottom' => '0',
                    'left' => '-10',
                    'unit' => 'px',
                    'isLinked' => false,
                );
            }

            if (isset($controls['_css_classes'])) {
                $controls['_css_classes']['default'] = '';
            }
        }

        return $controls;
    }

    protected function render() {
        $table = \Db::getInstance()->execute('SHOW TABLES LIKE \'' . _DB_PREFIX_ . 'smart_blog_post' . '\'');
        if (!$table) {
            echo 'Please install smartblog module first!';
        } else {
            $settings = $this->getSettings();

            $show_arrows = ($settings['show_arrows'] == 'on') ? 'true' : 'false';
            $show_dots = ($settings['show_dots'] == 'on') ? 'true' : 'false';
            $autoplay = ($settings['autoplay'] == 'on') ? 'true' : 'false';

            //$categories = explode(',', $settings['categories']);
            $categories = $settings['categories'];

            $posts = \NovElementor::NovgetBlogs('', $settings['limit'], $settings['orderby'], $settings['order'], $categories);

            $column = \NovElementor::get_classnumbercolumn($settings['columns'], $settings['columns_tablet'], $settings['number_row']);

            $this->context->smarty->assign(
                    array(
                        'posts' => $posts,
                        'nov_modules_dir' => _MODULE_DIR_,
                        'title' => $settings['title'],
                        'sub_title' => $settings['sub_title'],
                        'button' => $settings['button'],
                        'title_align' => $settings['title_align'],
                        'xl' => $settings['columns'],
                        'md' => $settings['columns_tablet'],
                        'xs' => $settings['columns_mobile'],
                        'column' => $column,
                        'number_row' => $settings['number_row'],
                        'show_arrows' => $show_arrows,
                        'show_dots' => $show_dots,
                        'autoplay' => $autoplay,
                        'el_class' => ''
                    )
            );

            $tpl = "module:novelementor/views/templates/front/widgets/nov-blog-list/{$settings['display_type']}.tpl";
            echo $this->context->smarty->fetch($tpl);
        }
    }

    protected function _contentTemplate() {
        
    }

    public function __construct($data = array(), $args = array()) {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }

}
