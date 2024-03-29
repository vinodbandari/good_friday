<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovLookBook extends WidgetBase
{
    public function getName()
    {
        return 'nov-lookbook';
    }

    public function getTitle()
    {
        return __('Nov LookBook', 'elementor');
    }

    public function getIcon()
    {
        return 'vinova-icon';
    }

    public function getCategories()
    {
        return array('vinova');
    }

    protected function _skinOptions()
    {
        $opts = array();
        $tpls = glob(_PS_THEME_DIR_ . 'templates/catalog/_partials/miniatures/*product*.tpl');

        foreach ($tpls as $tpl) {
            $opt = basename($tpl, '.tpl');
            $opts[$opt] = \Tools::ucFirst($opt);
        }

        return $opts;
    }

    protected function _listingOptions()
    {
        $opts = array(
            'category' => __('Featured Products', 'elementor'),
            'prices-drop' => __('Prices Drop', 'elementor'),
            'new-products' => __('New Products', 'elementor'),
        );

        if (!\Configuration::get('PS_CATALOG_MODE')) {
            $opts['best-sales'] = __('Best Sales', 'elementor');
        }

        return $opts;
    }

    protected function getLookBookItems() {
        $opts = array();

        $array_slides = \NovElementor::getLookbook();
        if($array_slides){
            foreach($array_slides as $array_slide){
                $opts[$array_slide['id_slide']] = $array_slide['title'];
            }
        }
        return $opts;
    }

    protected function _registerControls()
    {
        $this->startControlsSection(
            'section_lookbook_settings',
            array(
                'label' => __('Nov Lookbook Settings', 'elementor'),
            )
        );

        $this->addControl(
            'title',
            array(
                'label' => __('Title', 'elementor'),
                'type' => ControlsManager::TEXT,
                'default' => ''
            )
        );

        $this->addControl(
            'sub_title',
            array(
                'label' => __('Sub Title', 'elementor'),
                'type' => ControlsManager::TEXT,
                'default' => '',
            'condition' => array(
                'display_type' => array('grid-type'),
            ),
            )
        );

        $this->addControl(
            'contenttext',
            array(
                'label' => __('Description Title', 'elementor'),
                'type' => ControlsManager::TEXTAREA,
                'rows' => 3,
                'default' => '',
            'condition' => array(
                'display_type' => array('grid-type'),
            ),
            )
        );
        $this->addControl(
                'display_type', array(
            'label' => __('Display Style', 'elementor'),
            'type' => ControlsManager::SELECT,
            'default' => 'grid-type',
            'options' => array(
                'grid-type' => __('Grid Stype 1', 'elementor'),
                'list-type' => __('List Stype 1', 'elementor'),
                'list-type-2' => __('List Stype 2', 'elementor'),
            )
                )
        );
        $this->addControl(
            'lookbookitems',
            array(
                'label' => __('Select Lookbook Items', 'elementor'),
                'type' => ControlsManager::SELECT2,
                'multiple' => true,
                'options' => $this->getLookBookItems()
            )
        );


        $this->endControlsSection();
    }

    public function getControls($control_id = null)
    {
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

    protected function render()
    {
        $table = \Db::getInstance()->execute('SHOW TABLES LIKE \''._DB_PREFIX_.'novlookbook'.'\'');
        if (!$table) {
            echo 'Please install lookbook module first!';
        }
        else {
            $settings = $this->getSettings();
            if(empty($settings['lookbookitems'])) return;

            $lookbooks = array();
            $filter = ' AND hs.`id_novlookbook_slides` IN ('. implode(',',$settings['lookbookitems']).')';

            $lookbooks = \NovElementor::getLookbook($filter);
            if (is_array($lookbooks)) {
                foreach ($lookbooks as &$slide) {
                    $slide['sizes'] = @getimagesize((dirname(__FILE__).DIRECTORY_SEPARATOR.'views/img'.DIRECTORY_SEPARATOR.$slide['image']));
                    if (isset($slide['sizes'][3]) && $slide['sizes'][3]) {
                        $slide['size'] = $slide['sizes'][3];
                    }

                    if ($slide['hotsposts']) {
                        $hotsposts = $slide['hotsposts'];
                        $hotsposts = json_decode($hotsposts);
                        foreach ($hotsposts as &$hotspost) {
                            $hotspost = (array) $hotspost;
                            $style = "";
                            $hotspost['left'] = round(($hotspost['left']/$hotspost['imgW'])*100, 2);
                            $hotspost['top'] = round(($hotspost['top']/$hotspost['imgH'])*100, 2);
                            if ($hotspost['top'] > 50) {
                                $style .= " bottom:65px;";
                            } else {
                                $style .= " top:65px;";
                            }

                            $hotspost['style'] = $style;

                            if (!empty($hotspost['sku'])) {
                                $product = new \Product((int)$hotspost['sku'], false, (int)$this->context->language->id);
                                $price_tax_incl = \Product::getPriceStatic((int)$hotspost['sku'], false);
                                $hotspost['name'] = $product->name;
                                $hotspost['description_short'] = $product->description_short;
                                $hotspost['link_rewrite'] = $product->link_rewrite;
                                $hotspost['link'] = $this->context->link->getProductLink($product);
                                $currency = $this->context->currency;
                                $hotspost['price'] = \Tools::displayPrice(\Tools::convertPrice($price_tax_incl, $currency), $currency);
                                $image = \Product::getCover((int)$hotspost['sku']);
                                $image = new \Image($image['id_image']);
                                $hotspost['image'] = _PS_BASE_URL_._THEME_PROD_DIR_.$image->getExistingImgPath().".jpg";
                                if(\Configuration::get('PS_SSL_ENABLED'))
                                    $hotspost['image'] = _PS_BASE_URL_SSL_._THEME_PROD_DIR_.$image->getExistingImgPath().".jpg";
                                else
                                    $hotspost['image'] = _PS_BASE_URL_._THEME_PROD_DIR_.$image->getExistingImgPath().".jpg";
                            }
                        }
                        $slide['hotsposts'] = $hotsposts;
                    }
                }
            }

           // $column = \NovElementor::get_classnumbercolumn($settings['columns'], $settings['columns_tablet'], $settings['number_row']);

            $this->context->smarty->assign('settings', $settings);
           // $this->context->smarty->assign('column', $column);
            $this->context->smarty->assign('lookbooks', $lookbooks);
            $this->context->smarty->assign('nov_dir', __PS_BASE_URI__);

            $tpl = "module:novelementor/views/templates/front/widgets/nov-lookbook/{$settings['display_type']}.tpl";
            echo $this->context->smarty->fetch($tpl);
        }
    }

    protected function _contentTemplate()
    {
    }

    public function __construct($data = array(), $args = array())
    {
        $this->context = \Context::getContext();

        parent::__construct($data, $args);
    }
}
