<?php

namespace NovElementor\TemplateLibrary;

defined('_PS_VERSION_') or exit;

use NovElementor\Plugin;
use NovElementor\TemplateLibrary\Classes\ImportImages;

class Manager
{
    /**
     * @var SourceBase[]
     */
    protected $_registered_sources = array();

    private $_import_images = null;

    public function __construct()
    {
        $this->registerDefaultSources();

        // $this->initAjaxCalls();
    }

    /**
     * @return ImportImages
     */
    public function getImportImagesInstance()
    {
        if (null === $this->_import_images) {
            $this->_import_images = new ImportImages();
        }

        return $this->_import_images;
    }

    public function registerSource($source_class, $args = array())
    {
        if (!class_exists($source_class)) {
            return new \PrestaShopException('source_class_name_not_exists');
        }

        $source_instance = new $source_class($args);

        if (!$source_instance instanceof SourceBase) {
            return new \PrestaShopException('wrong_instance_source');
        }
        $this->_registered_sources[$source_instance->getId()] = $source_instance;

        return true;
    }

    public function unregisterSource($id)
    {
        if (!isset($this->_registered_sources[$id])) {
            return false;
        }

        unset($this->_registered_sources[$id]);

        return true;
    }

    public function getRegisteredSources()
    {
        return $this->_registered_sources;
    }

    public function getSource($id)
    {
        $sources = $this->getRegisteredSources();

        if (!isset($sources[$id])) {
            return false;
        }

        return $sources[$id];
    }

    public function getTemplates()
    {
        $templates = array();

        foreach ($this->getRegisteredSources() as $source) {
            $templates = array_merge($templates, $source->getItems());
        }

        return $templates;
    }

    public function saveTemplate(array $args)
    {
        $validate_args = $this->ensureArgs(array('source', 'data'), $args);

        if (\NovElementor\is_wp_error($validate_args)) {
            return $validate_args;
        }

        $source = $this->getSource($args['source']);

        if (!$source) {
            return new \PrestaShopException('template_error - Template source not found.');
        }

        $args['data'] = json_decode(html_entity_decode($args['data']), true);

        $template_id = $source->saveItem($args);

        if (\NovElementor\is_wp_error($template_id)) {
            return $template_id;
        }

        return $source->getItem($template_id);
    }

    public function updateTemplate(array $template_data)
    {
        $validate_args = $this->ensureArgs(array('source', 'data'), $template_data);

        if (\NovElementor\is_wp_error($validate_args)) {
            return $validate_args;
        }

        $source = $this->getSource($template_data['source']);

        if (!$source) {
            return new \PrestaShopException('template_error - Template source not found.');
        }

        $template_data['data'] = json_decode(html_entity_decode($template_data['data']), true);

        $update = $source->updateItem($template_data);

        if (\NovElementor\is_wp_error($update)) {
            return $update;
        }

        return $source->getItem($template_data['id']);
    }

    public function updateTemplates(array $args)
    {
        foreach ($args['templates'] as $template_data) {
            $this->updateTemplate($template_data);
        }
    }

    public function getTemplateContent(array $args)
    {
        $validate_args = $this->ensureArgs(array('source', 'template_id'), $args);

        if (\NovElementor\is_wp_error($validate_args)) {
            return $validate_args;
        }

        if (isset($args['edit_mode'])) {
            Plugin::instance()->editor->setEditMode($args['edit_mode']);
        }

        $source = $this->getSource($args['source']);

        if (!$source) {
            return new \PrestaShopException('template_error - Template source not found.');
        }

        return $source->getContent($args['template_id']);
    }

    public function deleteTemplate(array $args)
    {
        $validate_args = $this->ensureArgs(array('source', 'template_id'), $args);

        if (\NovElementor\is_wp_error($validate_args)) {
            return $validate_args;
        }

        $source = $this->getSource($args['source']);

        if (!$source) {
            return new \PrestaShopException('template_error - Template source not found.');
        }

        $source->deleteTemplate($args['template_id']);

        return true;
    }

    public function exportTemplate(array $args)
    {
        // TODO: Add nonce for security
        $validate_args = $this->ensureArgs(array('source', 'template_id'), $args);

        if (\NovElementor\is_wp_error($validate_args)) {
            return $validate_args;
        }

        $source = $this->getSource($args['source']);

        if (!$source) {
            return new \PrestaShopException('template_error - Template source not found.');
        }

        // If you reach this line, the export was not successful
        return $source->exportTemplate($args['template_id']);
    }

    public function importTemplate()
    {
        /** @var Source_Local $source */
        $source = $this->getSource('local');

        return $source->importTemplate();
    }

    public function onImportTemplateSuccess()
    {
        wp_redirect(admin_url('edit.php?post_type=' . SourceLocal::CPT));
    }

    public function onImportTemplateError(\PrestaShopException $error)
    {
        echo $error->getMessage();
    }

    public function onExportTemplateError(\PrestaShopException $error)
    {
        echo $error->getMessage();
    }

    private function registerDefaultSources()
    {
        include _PS_MODULE_DIR_ . 'novelementor/includes/template-library/classes/class-import-images.php';
        include _PS_MODULE_DIR_ . 'novelementor/includes/template-library/sources/base.php';

        $sources = array(
            'local',
            'remote',
        );

        foreach ($sources as $source_filename) {
            include _PS_MODULE_DIR_ . 'novelementor/includes/template-library/sources/' . $source_filename . '.php';

            $class_name = str_replace('-', '', $source_filename);

            $this->registerSource(__NAMESPACE__ . '\Source' . $class_name);
        }
    }

    public function handleAjaxRequest($ajax_request)
    {
        $result = call_user_func(array($this, $ajax_request), \Tools::getAllValues());

        $request_type = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && \Tools::strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' ? 'ajax' : 'direct';

        if ('direct' === $request_type) {
            $callback = 'on' . $ajax_request;

            if (method_exists($this, $callback)) {
                $this->$callback($result);
            }
        }

        if (\NovElementor\is_wp_error($result)) {
            if ('ajax' === $request_type) {
                \NovElementor\wp_send_json_error($result->getMessage());
            }

            $callback = "on{$ajax_request}Error";

            if (method_exists($this, $callback)) {
                $this->$callback($result);
            }

            die;
        }

        if ('ajax' === $request_type) {
            \NovElementor\wp_send_json_success($result);
        }

        $callback = "on{$ajax_request}Success";

        if (method_exists($this, $callback)) {
            $this->$callback($result);
        }

        die;
    }

    /*
    private function initAjaxCalls()
    {
        $allowed_ajax_requests = array(
            'get_templates',
            'get_template_content',
            'save_template',
            'update_templates',
            'delete_template',
            'export_template',
            'import_template',
        );

        foreach ($allowed_ajax_requests as $ajax_request) {
            add_action('wp_ajax_elementor_' . $ajax_request, function () use ($ajax_request) {
                $this->handleAjaxRequest($ajax_request);
            });
        }
    }
    */

    private function ensureArgs(array $required_args, array $specified_args)
    {
        $not_specified_args = array_diff($required_args, array_keys(array_filter($specified_args)));

        if ($not_specified_args) {
            return new \PrestaShopException('arguments_not_specified - The required argument(s) `' . implode(', ', $not_specified_args) . '` not specified');
        }

        return true;
    }
}
