<?php defined('_PS_VERSION_') or exit;

require_once _PS_MODULE_DIR_ . 'novelementor/includes/plugin.php';

use NovElementor\Helper;
use NovElementor\Plugin;

class NovElementorEditorController extends ModuleAdminController
{
    public $name = 'NovElementorEditor';

    public $display_header = false;

    public $content_only = true;

    public function init()
    {
        if (Shop::isFeatureActive()) {
            $protocol = Tools::getShopProtocol();
            $domain = array(
                'http://' => 'domain',
                'https://' => 'domain_ssl',
            );

            if ($_SERVER['HTTP_HOST'] != $this->context->shop->{$domain[$protocol]}) {
                NovElementor\update_option('cookie', $this->context->cookie->getAll());
                $preview = $this->context->link->getModuleLink('novelementor', 'preview', array(
                    'id_employee' => $this->context->employee->id,
                    'adtoken' => Tools::getAdminTokenLite('AdminNovElementor'),
                    'redirect' => urlencode($_SERVER['REQUEST_URI']),
                ), true);
                Tools::redirectAdmin($preview);
            }
        }
    }

    public function initContent()
    {
        if (!Tools::getValue('id', Tools::getValue('id_page')) || !Tools::getValue('id_lang') || !Tools::getValue('type')) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminNovElementor'));
        }
        $this->productLink = $this->context->link->getAdminLink('AdminProducts');

        Plugin::instance()->editor->init();
    }

    public function ajaxProcessSaveBuilder()
    {
        $id = (int) Tools::getValue('post_id');
        $type = Tools::getValue('post_type');
        $id_lang = (int) Tools::getValue('lang_id');
        $data = empty(${'_POST'}['data']) ? '' : ${'_POST'}['data'];
        $plugin = Plugin::instance();

        switch ($type) {
            case 'cms':
            case 'category':
            case 'product':
            case 'smartblog':
            case 'displayFooterProduct':
                $elem = NovElementorPage::getInstance($type, $id);
                $elem->data[$id_lang] = $data;
                break;
            default:
                $elem = new NovElementorPage($id);
                $elem->data[$id_lang] = $data;
                break;
        }

        $success = $elem->id ? $elem->update() : $elem->add();
        $plugin->posts_css_manager->onSavePost($elem->id, $id_lang);

        $this->displayJSON(array(
            'success' => $success,
        ));
    }

    public function ajaxProcessGetTemplates()
    {
        return Plugin::instance()->templates_manager->handleAjaxRequest('getTemplates');
    }

    public function ajaxProcessSaveTemplate()
    {
        return Plugin::instance()->templates_manager->handleAjaxRequest('saveTemplate');
    }

    public function ajaxProcessDeleteTemplate()
    {
        return Plugin::instance()->templates_manager->handleAjaxRequest('deleteTemplate');
    }

    public function ajaxProcessGetTemplateContent()
    {
        return Plugin::instance()->templates_manager->handleAjaxRequest('getTemplateContent');
    }

    public function ajaxProcessExportTemplate()
    {
        return Plugin::instance()->templates_manager->handleAjaxRequest('exportTemplate');
    }

    public function ajaxProcessImportTemplate()
    {
        return Plugin::instance()->templates_manager->handleAjaxRequest('importTemplate');
    }

    public function ajaxProcessApplyScheme()
    {
        Plugin::instance()->schemes_manager->ajaxApplyScheme();
    }

    public function displayJSON($res)
    {
        header('Content-Type: application/json');
        die(json_encode($res));
    }

    public function initProcess()
    {
    }

    public function initBreadcrumbs($tab_id = null, $tabs = null)
    {
    }

    public function initModal()
    {
    }

    public function initToolbarFlags()
    {
    }

    public function initNotifications()
    {
    }
}
