<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class WidgetNovContactForm extends WidgetBase
{
    public function getName()
    {
        return 'nov-contact-form';
    }

    public function getTitle()
    {
        return __('Nov Contact Form', 'elementor');
    }

    public function getIcon()
    {
        return 'vinova-icon';
    }

    public function getCategories()
    {
        return array('vinova');
    }

    protected function _registerControls()
    {
        $this->startControlsSection(
            'section_contactform',
            array(
                'label' => __('Nov Contact Form Settings', 'elementor'),
            )
        );

        $this->addControl(
            'title',
            array(
                'label' => __('Title', 'elementor'),
                'type' => ControlsManager::TEXT,
                'placeholder' => '',
                'label_block' => true,
            )
        );

        $this->addControl(
            'sub_title',
            array(
                'label' => __('Sub Title', 'elementor'),
                'type' => ControlsManager::TEXT,
                'placeholder' => '',
                'label_block' => true,
            )
        );

        $this->addControl(
            'desc_title',
            array(
                'label' => __('Description Title', 'elementor'),
                'type' => ControlsManager::TEXT,
                'placeholder' => '',
                'label_block' => true,
            )
        );

        $this->addControl(
            'display_type',
            array(
                'label' => __('Display Style', 'elementor'),
                'type' => ControlsManager::SELECT,
                'default' => 'style-1',
                'options' => array(
                    'style-1' => __('Style 1', 'elementor'),
                    'style-2' => __('Style 2', 'elementor'),
                    'style-3' => __('Style 3', 'elementor'),
                    'style-4' => __('Style 4', 'elementor'),
                )
            )
        );

        $this->endControlsSection();
    }

    protected function render()
    {
        $settings = $this->getSettings();

        global $notifications;
        global $contact;
        $contacts = \Contact::getContacts($this->context->language->id);
        $token = \Tools::getAdminToken('[classname]'.intval(\Tab::getIdFromClassName('[classname]')));

        $this->context->smarty->assign(
            array(
                'title' => $settings['title'],
                'sub_title' => $settings['sub_title'],
                'desc_title' => $settings['desc_title'],
                'link' => $this->context->link,
                'notifications' => $notifications,
                'contact' => $contact,
                'contacts' => $contacts,
                'token' => $token,
                'el_class' => '',
            )
        );

        $tpl = "module:novelementor/views/templates/front/widgets/nov-contact-form/{$settings['display_type']}.tpl";
        echo $this->context->smarty->fetch($tpl);
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
