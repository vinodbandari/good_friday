<?php

defined('_PS_VERSION_') or exit;

require_once _PS_MODULE_DIR_ . '/novelementor/src/NovElementorPage.php';

class AdminNovElementorController extends ModuleAdminController {
    public $bootstrap = true;

    public function __construct()
    {
        $this->table = 'novelementor';
        $this->identifier = 'id';
        $this->lang = true;
        $this->className = 'NovElementorPage';
        parent::__construct();

        if ((Tools::getIsset('updatenovelementor') || Tools::getIsset('addnovelementor')) && Shop::getContextShopID() === null) {
            $this->displayWarning(
                $this->trans('You are in a multistore context: any modification will impact all your shops, or each shop of the active group.', array(), 'Admin.Catalog.Notification')
            );
        }

        $this->addRowAction('edit');
        $this->addRowAction('delete');

        $table_shop = _DB_PREFIX_ . $this->table . '_shop';
        $this->_join = "LEFT JOIN $table_shop sa ON sa.id = a.id AND b.id_shop = sa.id_shop";
        $this->_where = "AND sa.id_shop = {$this->context->shop->id} AND id_page = 0 AND active < 2";
        $this->_orderBy = 'title';
        $this->_use_found_rows = false;

        $this->fields_list = array(
            'id' => array(
                'title' => $this->trans('ID', array(), 'Admin.Global'),
                'class' => 'fixed-width-xs',
                'align' => 'center',
                'orderby' => true,
            ),
            'title' => array(
                'title' => $this->trans('Title', array(), 'Admin.Global'),
                'orderby' => true,
            ),
            'type' => array(
                'title' => $this->trans('Position', array(), 'Admin.Global'),
                'orderby' => true,
            ),
            'active' => array(
                'title' => $this->trans('Displayed', array(), 'Admin.Global'),
                'align' => 'center',
                'active' => 'status',
                'type' => 'bool',
                'orderby' => false,
            ),
            'date_add' => array(
                'title' => $this->trans('Created on', array(), 'Modules.Facetedsearch.Admin'),
                'class' => 'fixed-width-lg',
                'type' => 'datetime',
            ),
            'date_upd' => array(
                'title' => $this->l('Modified on'),
                'class' => 'fixed-width-lg',
                'type' => 'datetime',
            ),
        );

        $this->bulk_actions = array(
            'delete' => array(
                'text' => $this->trans('Delete selected', array(), 'Admin.Notifications.Info'),
                'icon' => 'icon-trash',
                'confirm' => $this->trans('Delete selected items?', array(), 'Admin.Notifications.Info')
            ),
        );
    }

    public function setMedia($isNewTheme = false)
    {
        $this->addJquery();
        $this->addJs(_PS_JS_DIR_ . 'jquery/jquery-'._PS_JQUERY_VERSION_.'.min.js', true);
        $this->js_files[] = _MODULE_DIR_ . 'novelementor/views/lib/select2/js/select2.min.js';
        $this->css_files[_MODULE_DIR_ . 'novelementor/views/lib/select2/css/select2.min.css'] = 'all';

        return parent::setMedia($isNewTheme);
    }

    public function getList($id_lang, $order_by = null, $order_way = null, $start = 0, $limit = null, $id_lang_shop = false)
    {
        parent::getList($id_lang, $order_by, $order_way, $start, $limit, $id_lang_shop); // TODO: Change the autogenerated stub
    }

    public function renderList()
    {
        return parent::renderList(); // TODO: Change the autogenerated stub
    }

    public function renderView()
    {
        if (($elem = $this->loadObject(true)) && Validate::isLoadedObject($elem)) {
            $link = $this->context->link->getAdminLink('AdminNovElementor') . '&id=' . $elem->id;
            Tools::redirectLink($link);
        }
        return $this->displayWarning($this->trans('Page not found', array(), 'Admin.Notifications.Error'));
    }

    public function renderForm()
    {
        if (($elem = $this->loadObject(true)) && Validate::isLoadedObject($elem)) {
            $link = $this->context->link->getAdminLink('AdminNovElementor') . '&id=' . $elem->id;
        }

        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Content')
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->trans('Title', array(), 'Admin.Global'),
                    'name' => 'title',
                    'lang' => true,
                    'col' => 4,
                ),
                array(
                    'type' => 'text',
                    'label' => $this->trans('Position', array(), 'Admin.Global'),
                    'name' => 'type',
                    'required' => true,
                    'col' => 3,
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Content'),
                    'name' => 'content',
                    'lang' => true,
                    'col' => 4,
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->trans('Displayed', array(), 'Admin.Global'),
                    'name' => 'active',
                    'required' => false,
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->trans('Enabled', array(), 'Admin.Global'),
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->trans('Disabled', array(), 'Admin.Global'),
                        ),
                    ),
                ),
            ),
            'submit' => array(
                'title' => $this->trans('Save and stay', array(), 'Admin.Actions'),
                'stay' => true,
            ),
        );

        if (Shop::isFeatureActive()) {
            $this->fields_form['input'][] = array(
                'type' => 'shop',
                'label' => $this->trans('Shop association', array(), 'Admin.Global'),
                'name' => 'checkBoxShopAsso',
            );
        }

        return parent::renderForm(); // TODO: Change the autogenerated stub
    }

    protected function trans($id, array $parameters = array(), $domain = null, $locale = null)
    {
        return empty($this->translator) ? $this->l($id) : parent::trans($id, $parameters, $domain, $locale);
    }

    protected function l($string, $module = null, $addslashes = false, $htmlentities = true)
    {
        $str = Translate::getModuleTranslation(null === $module ? 'novelementor' : $module, $string, '', null, $addslashes || !$htmlentities);

        return $htmlentities ? $str : call_user_func('strip' . 'slashes', $str);
    }
}