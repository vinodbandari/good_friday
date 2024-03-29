<?php
/******************
 * Vinova Themes  Framework for Prestashop 1.6.x 
 * @package   	novnivoslider
 * @version   	1.0
 * @author   	http://vinovathemes.com/
 * @copyright 	Copyright (C) October 2013 vinovathemes.com <@emai:vinovathemes@gmail.com>
 * <info@vinovathemes.com>.All rights reserved.
 * @license   GNU General Public License version 1
 * *****************/

if (!defined('_PS_VERSION_'))
	exit;

include_once(_PS_MODULE_DIR_.'novnivoslider/novslide.php');

class novnivoslider extends Module
{
	private $_html = '';

	public function __construct()
	{
		$this->name = 'novnivoslider';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'VinovaThemes';
		$this->need_instance = 0;
		$this->secure_key = Tools::encrypt($this->name);
		$this->bootstrap = true;
			
		parent::__construct();
		
			
		$this->displayName = $this->l('Vinova Image NivoSlider for your homepage');
		$this->description = $this->l('Adds an image slider to your homepage.');
		$this->ps_versions_compliancy = array('min' => '1.6.0.4', 'max' => _PS_VERSION_);
	}

	/**
	 * @see Module::install()
	 */
	public function install()
	{
		/* Adds Module */
		if (parent::install() &&
			$this->registerHook('displayHeader') &&
			$this->registerHook('actionShopDataDuplication')
		)
		
		{
			return true;
		}

		return false;
	}


	/**
	 * @see Module::uninstall()
	 */
	public function uninstall()
	{
		/* Deletes Module */
		if (parent::uninstall())
		{
			return true;
		}

		return false;
	}


	public function getContent()
	{
		$this->_html .= $this->headerHTML();

		/* Validate & process */
		if (Tools::isSubmit('submitSlide') || Tools::isSubmit('delete_id_slide') ||
			Tools::isSubmit('changeStatus')
		)
		{
			if ($this->_postValidation())
			{
				$this->_postProcess();
				$this->_html .= $this->renderList();
			}
			else
				$this->_html .= $this->renderAddForm();

		}
		elseif (Tools::isSubmit('addSlide') || (Tools::isSubmit('id_slide') && $this->slideExists((int)Tools::getValue('id_slide'))))
			$this->_html .= $this->renderAddForm();
		else
		{
			$this->_html .= $this->renderList();
		}

		return $this->_html;
	}

	private function _postValidation()
	{
		$errors = array();
		
		if (Tools::isSubmit('changeStatus'))
		{
			if (!Validate::isInt(Tools::getValue('id_slide')))
				$errors[] = $this->l('Invalid slide');
		}
		/* Validation for Slide */
		elseif (Tools::isSubmit('submitSlide'))
		{
			/* Checks state (active) */
			if (!Validate::isInt(Tools::getValue('active_slide')) || (Tools::getValue('active_slide') != 0 && Tools::getValue('active_slide') != 1))
				$errors[] = $this->l('Invalid slide state.');
			/* Checks position */
			if (!Validate::isInt(Tools::getValue('position')) || (Tools::getValue('position') < 0))
				$errors[] = $this->l('Invalid slide position.');
			/* If edit : checks id_slide */
			if (Tools::isSubmit('id_slide'))
			{

				//d(var_dump(Tools::getValue('id_slide')));
				if (!Validate::isInt(Tools::getValue('id_slide')) && !$this->slideExists(Tools::getValue('id_slide')))
					$errors[] = $this->l('Invalid slide ID');
			}
			/* Checks title/url/legend/description/image */
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
			{
				if (Tools::strlen(Tools::getValue('title_'.$language['id_lang'])) > 255)
					$errors[] = $this->l('The title is too long.');
				if (Tools::strlen(Tools::getValue('legend_'.$language['id_lang'])) > 255)
					$errors[] = $this->l('The caption is too long.');
				if (Tools::strlen(Tools::getValue('url_'.$language['id_lang'])) > 255)
					$errors[] = $this->l('The URL is too long.');
				if (Tools::strlen(Tools::getValue('description_'.$language['id_lang'])) > 4000)
					$errors[] = $this->l('The description is too long.');
				if (Tools::strlen(Tools::getValue('url_'.$language['id_lang'])) > 0 && !Validate::isUrl(Tools::getValue('url_'.$language['id_lang'])))
					$errors[] = $this->l('The URL format is not correct.');
				if (Tools::getValue('image_'.$language['id_lang']) != null && !Validate::isFileName(Tools::getValue('image_'.$language['id_lang'])))
					$errors[] = $this->l('Invalid filename.');
				if (Tools::getValue('image_old_'.$language['id_lang']) != null && !Validate::isFileName(Tools::getValue('image_old_'.$language['id_lang'])))
					$errors[] = $this->l('Invalid filename.');
			}

			/* Checks title/url/legend/description for default lang */
			$id_lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
			if (Tools::strlen(Tools::getValue('title_'.$id_lang_default)) == 0)
				$errors[] = $this->l('The title is not set.');
			if (Tools::strlen(Tools::getValue('legend_'.$id_lang_default)) == 0)
				$errors[] = $this->l('The caption is not set.');
			if (Tools::strlen(Tools::getValue('url_'.$id_lang_default)) == 0)
				$errors[] = $this->l('The URL is not set.');
			if (!Tools::isSubmit('has_picture') && (!isset($_FILES['image_'.$id_lang_default]) || empty($_FILES['image_'.$id_lang_default]['tmp_name'])))
				$errors[] = $this->l('The image is not set.');
			if (Tools::getValue('image_old_'.$id_lang_default) && !Validate::isFileName(Tools::getValue('image_old_'.$id_lang_default)))
				$errors[] = $this->l('The image is not set.');
		} /* Validation for deletion */
		elseif (Tools::isSubmit('delete_id_slide') && (!Validate::isInt(Tools::getValue('delete_id_slide')) || !$this->slideExists((int)Tools::getValue('delete_id_slide'))))
			$errors[] = $this->l('Invalid slide ID');

		/* Display errors if needed */
		if (count($errors))
		{
			$this->_html .= $this->displayError(implode('<br />', $errors));

			return false;
		}

		/* Returns if validation is ok */

		return true;
	}

	private function _postProcess()
	{
		$errors = array();

		if (Tools::isSubmit('changeStatus') && Tools::isSubmit('id_slide'))
		{
			$slide = new NovSlide((int)Tools::getValue('id_slide'));
			if ($slide->active == 0)
				$slide->active = 1;
			else
				$slide->active = 0;
			$res = $slide->update();
			$this->_html .= ($res ? $this->displayConfirmation($this->l('Configuration updated')) : $this->displayError($this->l('The configuration could not be updated.')));
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=1&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
		}
		/* Processes Slide */
		elseif (Tools::isSubmit('submitSlide'))
		{
			/* Sets ID if needed */
			if (Tools::getValue('id_slide'))
			{
				$slide = new NovSlide((int)Tools::getValue('id_slide'));
				if (!Validate::isLoadedObject($slide))
				{
					$this->_html .= $this->displayError($this->l('Invalid slide ID'));

					return false;
				}
			}
			else
				$slide = new NovSlide();
			/* Sets position */
			$slide->position = (int)Tools::getValue('position');
			/* Sets active */
			$slide->active = (int)Tools::getValue('active_slide');
			$slide->align = Tools::getValue('align');
			$slide->effect_title = Tools::getValue('effect_title');
			$slide->effect_description = Tools::getValue('effect_description');
			$slide->effect_html = Tools::getValue('effect_html');

			/* Sets each langue fields */
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
			{
				$slide->title[$language['id_lang']] = Tools::getValue('title_'.$language['id_lang']);
				$slide->url[$language['id_lang']] = Tools::getValue('url_'.$language['id_lang']);
				$slide->legend[$language['id_lang']] = Tools::getValue('legend_'.$language['id_lang']);
				$slide->description[$language['id_lang']] = Tools::getValue('description_'.$language['id_lang']);
				$slide->html[$language['id_lang']] = Tools::getValue('html_'.$language['id_lang']);

				/* Uploads image and sets slide */
				$type = Tools::strtolower(Tools::substr(strrchr($_FILES['image_'.$language['id_lang']]['name'], '.'), 1));
				$imagesize = @getimagesize($_FILES['image_'.$language['id_lang']]['tmp_name']);
				if (isset($_FILES['image_'.$language['id_lang']]) &&
					isset($_FILES['image_'.$language['id_lang']]['tmp_name']) &&
					!empty($_FILES['image_'.$language['id_lang']]['tmp_name']) &&
					!empty($imagesize) &&
					in_array(
						Tools::strtolower(Tools::substr(strrchr($imagesize['mime'], '/'), 1)), array(
							'jpg',
							'gif',
							'jpeg',
							'png'
						)
					) &&
					in_array($type, array('jpg', 'gif', 'jpeg', 'png'))
				)
				{
					$temp_name = tempnam(_PS_TMP_IMG_DIR_, 'PS');
					$salt = sha1(microtime());
					if ($error = ImageManager::validateUpload($_FILES['image_'.$language['id_lang']]))
						$errors[] = $error;
					elseif (!$temp_name || !move_uploaded_file($_FILES['image_'.$language['id_lang']]['tmp_name'], $temp_name))
						return false;
					elseif (!ImageManager::resize($temp_name, dirname(__FILE__).'/images/'.$salt.'_'.$_FILES['image_'.$language['id_lang']]['name'], null, null, $type))
						$errors[] = $this->displayError($this->l('An error occurred during the image upload process.'));
					if (isset($temp_name))
						@unlink($temp_name);
					$slide->image[$language['id_lang']] = $salt.'_'.$_FILES['image_'.$language['id_lang']]['name'];
				}
				elseif (Tools::getValue('image_old_'.$language['id_lang']) != '')
					$slide->image[$language['id_lang']] = Tools::getValue('image_old_'.$language['id_lang']);
			}

			/* Processes if no errors  */
			if (!$errors)
			{
				/* Adds */
				if (!Tools::getValue('id_slide'))
				{
					if (!$slide->add())
						$errors[] = $this->displayError($this->l('The slide could not be added.'));
				}
				/* Update */
				elseif (!$slide->update())
					$errors[] = $this->displayError($this->l('The slide could not be updated.'));
			}
		} /* Deletes */
		elseif (Tools::isSubmit('delete_id_slide'))
		{
			$slide = new NovSlide((int)Tools::getValue('delete_id_slide'));
			$res = $slide->delete();
			if (!$res)
				$this->_html .= $this->displayError('Could not delete.');
			else
				Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=1&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
		}

		/* Display errors if needed */
		if (count($errors))
			$this->_html .= $this->displayError(implode('<br />', $errors));
		elseif (Tools::isSubmit('submitSlide') && Tools::getValue('id_slide'))
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=4&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
		elseif (Tools::isSubmit('submitSlide'))
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=3&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
	}

	public function hookdisplayHeader($params)
	{
		if (!isset($this->context->controller->php_self) || $this->context->controller->php_self != 'index')
			return;
		$this->context->controller->addJS($this->_path.'js/jquery.nivo.slider.js');
		return $this->display(__FILE__, 'header.tpl');
	}

	public function hookActionShopDataDuplication($params)
	{
		Db::getInstance()->execute('
			INSERT IGNORE INTO '._DB_PREFIX_.'novnivoslider (id_novnivoslider_slides, id_shop)
			SELECT id_novnivoslider_slides, '.(int)$params['new_id_shop'].'
			FROM '._DB_PREFIX_.'novnivoslider
			WHERE id_shop = '.(int)$params['old_id_shop']
		);
	}

	public function headerHTML()
	{
		if (Tools::getValue('controller') != 'AdminModules' && Tools::getValue('configure') != $this->name)
			return;

		$this->context->controller->addJqueryUI('ui.sortable');
		/* Style & js for fieldset 'slides configuration' */
		$html = '<script type="text/javascript">
			$(function() {
				var $mySlides = $("#slides");
				$mySlides.sortable({
					opacity: 0.6,
					cursor: "move",
					update: function() {
						var order = $(this).sortable("serialize") + "&action=updateSlidesPosition";
						$.post("'.$this->context->shop->physical_uri.$this->context->shop->virtual_uri.'modules/'.$this->name.'/ajax_'.$this->name.'.php?secure_key='.$this->secure_key.'", order);
						}
					});
				$mySlides.hover(function() {
					$(this).css("cursor","move");
					},
					function() {
					$(this).css("cursor","auto");
				});
			});
		</script>';

		return $html;
	}

	public function getNextPosition()
	{
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT MAX(hss.`position`) AS `next_position`
			FROM `'._DB_PREFIX_.'novnivoslider_slides` hss, `'._DB_PREFIX_.'novnivoslider` hs
			WHERE hss.`id_novnivoslider_slides` = hs.`id_novnivoslider_slides` AND hs.`id_shop` = '.(int)$this->context->shop->id
		);

		return (++$row['next_position']);
	}

	public function getSlides($active = null)
	{
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		$id_lang = $this->context->language->id;

		return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT hs.`id_novnivoslider_slides` as id_slide, hssl.`image`, hss.`position`,hss.`align`,hss.`effect_title`,hss.`effect_description`,hss.`effect_html`,hss.`active`, hssl.`title`,
			hssl.`url`, hssl.`legend`, hssl.`description`, hssl.`image`, hssl.`html`
			FROM '._DB_PREFIX_.'novnivoslider hs
			LEFT JOIN '._DB_PREFIX_.'novnivoslider_slides hss ON (hs.id_novnivoslider_slides = hss.id_novnivoslider_slides)
			LEFT JOIN '._DB_PREFIX_.'novnivoslider_slides_lang hssl ON (hss.id_novnivoslider_slides = hssl.id_novnivoslider_slides)
			WHERE id_shop = '.(int)$id_shop.'
			AND hssl.id_lang = '.(int)$id_lang .
			($active ? ' AND hss.`active` = 1' : ' ').'
			ORDER BY hssl.title'
		);
	}

	public function getAllImagesBySlidesId($id_slides, $active = null, $id_shop = null)
	{
		$this->context = Context::getContext();
		$images = array();

		if (!isset($id_shop))
			$id_shop = $this->context->shop->id;

		$results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT hssl.`image`, hssl.`id_lang`
			FROM '._DB_PREFIX_.'novnivoslider hs
			LEFT JOIN '._DB_PREFIX_.'novnivoslider_slides hss ON (hs.id_novnivoslider_slides = hss.id_novnivoslider_slides)
			LEFT JOIN '._DB_PREFIX_.'novnivoslider_slides_lang hssl ON (hss.id_novnivoslider_slides = hssl.id_novnivoslider_slides)
			WHERE hs.`id_novnivoslider_slides` = '.(int)$id_slides.' AND hs.`id_shop` = '.(int)$id_shop.
			($active ? ' AND hss.`active` = 1' : ' ')
		);

		foreach ($results as $result)
			$images[$result['id_lang']] = $result['image'];

		return $images;
	}

	public function displayStatus($id_slide, $active)
	{
		$title = ((int)$active == 0 ? $this->l('Disabled') : $this->l('Enabled'));
		$icon = ((int)$active == 0 ? 'icon-remove' : 'icon-check');
		$class = ((int)$active == 0 ? 'btn-danger' : 'btn-success');
		$html = '<a class="btn '.$class.'" href="'.AdminController::$currentIndex.
			'&configure='.$this->name.'
				&token='.Tools::getAdminTokenLite('AdminModules').'
				&changeStatus&id_slide='.(int)$id_slide.'" title="'.$title.'"><i class="'.$icon.'"></i> '.$title.'</a>';

		return $html;
	}

	public function slideExists($id_slide)
	{
		$req = 'SELECT hs.`id_novnivoslider_slides` as id_slide
				FROM `'._DB_PREFIX_.'novnivoslider` hs
				WHERE hs.`id_novnivoslider_slides` = '.(int)$id_slide;
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);

		return ($row);
	}

	public function renderList()
	{
		$slides = $this->getSlides();
		foreach ($slides as $key => $slide)
			$slides[$key]['status'] = $this->displayStatus($slide['id_slide'], $slide['active']);

		$this->context->smarty->assign(
			array(
				'link' => $this->context->link,
				'slides' => $slides,
				'image_baseurl' => $this->_path.'images/'
			)
		);

		return $this->display(__FILE__, 'list.tpl');
	}

	public function renderAddForm()
	{
		$align = array(
			array(
				'id' => 'slider-none',
				'label' => $this->l('slider-none')
			),
			array(
				'id' => 'slider-left',
				'label' => $this->l('slider-left')
			),
			array(
				'id' => 'slider-center',
				'label' => $this->l('slider-center')
			),
			array(
				'id' => 'slider-right',
				'label' => $this->l('slider-right')
			)
		);
		
		$effect = array(
			array(
				'id' => 'effect-0',
				'label' => $this->l('effect-0')
			),
			array(
				'id' => 'effect-1',
				'label' => $this->l('left-right-1')
			),
			array(
				'id' => 'effect-2',
				'label' => $this->l('left-right-2')
			),
			array(
				'id' => 'effect-3',
				'label' => $this->l('left-right-3')
			),
			array(
				'id' => 'effect-4',
				'label' => $this->l('right-left-1')
			),
			array(
				'id' => 'effect-5',
				'label' => $this->l('right-left-2')
			),
			array(
				'id' => 'effect-6',
				'label' => $this->l('right-left-3')
			),
			array(
				'id' => 'effect-7',
				'label' => $this->l('top-bottom-1')
			),
			array(
				'id' => 'effect-8',
				'label' => $this->l('top-bottom-2')
			),
			array(
				'id' => 'effect-9',
				'label' => $this->l('top-bottom-3')
			),
			array(
				'id' => 'effect-10',
				'label' => $this->l('bottom-top-1')
			),
			array(
				'id' => 'effect-11',
				'label' => $this->l('bottom-top-2')
			),
			array(
				'id' => 'effect-12',
				'label' => $this->l('bottom-top-3')
			)
		);

		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Slide information'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					array(
						'type' => 'file_lang',
						'label' => $this->l('Select a file'),
						'name' => 'image',
						'lang' => true,
						'desc' => $this->l(sprintf('Maximum image size: %s.', ini_get('upload_max_filesize')))
					),
					array(
						'type' => 'text',
						'label' => $this->l('Slide title'),
						'name' => 'title',
						'lang' => true,
					),
					array(
						'type' => 'text',
						'label' => $this->l('Target URL'),
						'name' => 'url',
						'lang' => true,
					),
					array(
						'type' => 'text',
						'label' => $this->l('Caption'),
						'name' => 'legend',
						'lang' => true,
					),
					array(
						'type' => 'textarea',
						'label' => $this->l('Description'),
						'name' => 'description',
						'autoload_rte' => true,
						'lang' => true,
					),
					array(
						'type' => 'textarea',
						'label' => $this->l('Html'),
						'name' => 'html',
						'autoload_rte' => true,
						'lang' => true,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Enabled'),
						'name' => 'active_slide',
						'is_bool' => true,
						'values' => array(
							array(
								'id' => 'active_on',
								'value' => 1,
								'label' => $this->l('Yes')
							),
							array(
								'id' => 'active_off',
								'value' => 0,
								'label' => $this->l('No')
							)
						),
					),
					array(
	                    'type' 	  => 'select',
	                    'label'   => $this->l('Align Information'),
	                    'name' 	  => 'align',
	                    'options' => array(  'query' => $align ,
	                    'id' 	  => 'id',
	                    'name' 	  => 'label' ),
	                    'default' => "slide-none",
	                    'desc'    => $this->l('Select Product Type')
	                ),
					array(
	                    'type' 	  => 'select',
	                    'label'   => $this->l('Effect Title'),
	                    'name' 	  => 'effect_title',
	                    'options' => array(  'query' => $effect ,
	                    'id' 	  => 'id',
	                    'name' 	  => 'label' ),
	                    'default' => "effect-0",
	                    'desc'    => $this->l('Select Product Type')
	                ),
					array(
	                    'type' 	  => 'select',
	                    'label'   => $this->l('Effect Description'),
	                    'name' 	  => 'effect_description',
	                    'options' => array(  'query' => $effect ,
	                    'id' 	  => 'id',
	                    'name' 	  => 'label' ),
	                    'default' => "effect-0",
	                    'desc'    => $this->l('Select Product Type')
	                ),
					array(
	                    'type' 	  => 'select',
	                    'label'   => $this->l('Effect Html'),
	                    'name' 	  => 'effect_html',
	                    'options' => array(  'query' => $effect ,
	                    'id' 	  => 'id',
	                    'name' 	  => 'label' ),
	                    'default' => "effect-0",
	                    'desc'    => $this->l('Select Effect')
	                ),				
				),
				'submit' => array(
					'title' => $this->l('Save'),
				)
			),
		);

		if (Tools::isSubmit('id_slide') && $this->slideExists((int)Tools::getValue('id_slide')))
		{
			$slide = new NovSlide((int)Tools::getValue('id_slide'));
			$fields_form['form']['input'][] = array('type' => 'hidden', 'name' => 'id_slide');
			$fields_form['form']['images'] = $slide->image;
			
			$has_picture = true;

			foreach (Language::getLanguages(false) as $lang)
				if (!isset($slide->image[$lang['id_lang']]))
					$has_picture &= false;

			if ($has_picture)
				$fields_form['form']['input'][] = array('type' => 'hidden', 'name' => 'has_picture');
		}
		
		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table = $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$this->fields_form = array();
		$helper->module = $this;
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submitSlide';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$language = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->tpl_vars = array(
			'base_url' => $this->context->shop->getBaseURL(),
			'language' => array(
				'id_lang' => $language->id,
				'iso_code' => $language->iso_code
			),
			'fields_value' => $this->getAddFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id,
			'image_baseurl' => $this->_path.'images/'
		);
		
		$helper->override_folder = '/';

		return $helper->generateForm(array($fields_form));
	}

	public function getAddFieldsValues()
	{
		$fields = array();

		if (Tools::isSubmit('id_slide') && $this->slideExists((int)Tools::getValue('id_slide')))
		{
			$slide = new NovSlide((int)Tools::getValue('id_slide'));
			$fields['id_slide'] = (int)Tools::getValue('id_slide', $slide->id);
		}
		else
			$slide = new NovSlide();

		$fields['active_slide'] = Tools::getValue('active_slide', $slide->active);
		$fields['align'] = Tools::getValue('align', $slide->align);
		$fields['effect_title'] = Tools::getValue('effect_title', $slide->effect_title);
		$fields['effect_description'] = Tools::getValue('effect_description', $slide->effect_description);
		$fields['effect_html'] = Tools::getValue('effect_html', $slide->effect_html);
		$fields['has_picture'] = true;

		$languages = Language::getLanguages(false);

		foreach ($languages as $lang)
		{
			$fields['image'][$lang['id_lang']] = Tools::getValue('image_'.(int)$lang['id_lang']);
			$fields['title'][$lang['id_lang']] = Tools::getValue('title_'.(int)$lang['id_lang'], $slide->title[$lang['id_lang']]);
			$fields['url'][$lang['id_lang']] = Tools::getValue('url_'.(int)$lang['id_lang'], $slide->url[$lang['id_lang']]);
			$fields['legend'][$lang['id_lang']] = Tools::getValue('legend_'.(int)$lang['id_lang'], $slide->legend[$lang['id_lang']]);
			$fields['description'][$lang['id_lang']] = Tools::getValue('description_'.(int)$lang['id_lang'], $slide->description[$lang['id_lang']]);
			$fields['html'][$lang['id_lang']] = Tools::getValue('html_'.(int)$lang['id_lang'], $slide->html[$lang['id_lang']]);
		}

		return $fields;
	}
}
