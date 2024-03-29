<?php

defined('_PS_VERSION_') or exit;

require_once _PS_MODULE_DIR_ . 'novelementor/includes/plugin.php';

use NovElementor\Plugin;
use NovElementor\PostCssFile;

class NovElementorPreviewModuleFrontController extends ModuleFrontController
{
    public function init()
    {
        if (!NovElementor::hasAdminToken('AdminNovElementorPage')) {
            Tools::redirect('index.php?controller=404');
        }

        if (Tools::getIsset('redirect')) {
            $cookie = NovElementor\get_option('cookie');
            NovElementor\delete_option('cookie');

            if (!empty($cookie)) {
                $lifetime = max(1, (int) Configuration::get('PS_COOKIE_LIFETIME_BO')) * 3600 + time();
                $admin = new Cookie('psAdmin', '', $lifetime);
                foreach ($cookie as $key => &$value) {
                    $admin->{$key} = $value;
                }
                $admin->id_employee = Tools::getValue('id_employee');
                $admin->write();
            }
            Tools::redirectAdmin(urldecode(Tools::getValue('redirect')));
        }

        parent::init();
    }

    public function initContent()
    {
        if ($id = (int) Tools::getValue('id')) {
            parent::initContent();

            if (Tools::getIsset('cp_type')) {
                $elem = new stdClass();
                $elem->data = '[]';
            } else {
                $elem = new NovElementorPage($id, NovElementorPage::TPL_LANG, NovElementorPage::TPL_SHOP);

                $css_file = new PostCssFile($id, NovElementorPage::TPL_LANG, NovElementorPage::TPL_SHOP);
                $css_file->enqueue();
            }

            $this->context->smarty->assign(array(
                'nov_elements' => Plugin::instance(),
                'page_id' => $id,
                'page_data' => (array) json_decode($elem->data, true),
            ));

            $this->setTemplate('module:novelementor/views/templates/front/preview.tpl');
        }
    }
}
