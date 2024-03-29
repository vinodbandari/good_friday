<?php

namespace NovElementor\TemplateLibrary;

defined('_PS_VERSION_') or exit;

use NovElementor\Api;

class SourceRemote extends SourceBase
{

    public function getId()
    {
        return 'remote';
    }

    public function getTitle()
    {
        return __('Remote', 'elementor');
    }

    public function registerData()
    {
    }

    public function getItems()
    {
        $templates_data = Api::getTemplatesData();

        $templates = array();
        if (!empty($templates_data)) {
            foreach ($templates_data as $template_data) {
                $templates[] = $this->getItem($template_data);
            }
        }
        return $templates;
    }

    /**
     * @param array $template_data
     *
     * @return array
     */
    public function getItem($template_data)
    {
        return array(
            'template_id' => $template_data['id'],
            'source' => $this->getId(),
            'title' => $template_data['title'],
            'thumbnail' => $template_data['thumbnail'],
            'date' => date(\Context::getContext()->language->date_format_lite, $template_data['tmpl_created']),
            'author' => $template_data['author'],
            'categories' => array(),
            'keywords' => array(),
            'url' => $template_data['url'],
        );
    }

    public function saveItem($template_data)
    {
        return false;
    }

    public function updateItem($new_data)
    {
        return false;
    }

    public function deleteTemplate($item_id)
    {
        return false;
    }

    public function exportTemplate($item_id)
    {
        return false;
    }

    public function getContent($item_id, $context = 'display')
    {
        $data = Api::getTemplateContent($item_id);
        if (!$data) {
            return false;
        }

        $data = $this->replaceElementsIds($data);
        $data = $this->processExportImportData($data, 'onImport');

        return $data;
    }
}
