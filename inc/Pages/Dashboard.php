<?php
/**
 * @package  BasicPlugin
 */
namespace Inc\Pages;

use Inc\Api\Callbacks\ManagerCallbacks;
use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
 * 
 */
class Dashboard extends BaseController
{

	public $settings;
	public $callbacks;
	public $callbacks_mngr;
	public $pages = array();

	public function register()
	{

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();

		$this->setPages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages($this->pages)->withSubPage('Dashboard')->register();
	}

	public function setPages()
	{
		$this->pages = array(
			array(
				'page_title' => 'Basic Plugin',
				'menu_title' => 'Basic Menu Title',
				'capability' => 'manage_options',
				'menu_slug' => 'basic_plugin_menu_slug',
				'callback' => array($this->callbacks, 'adminDashboard'),
				'icon_url' => 'dashicons-store',
				'position' => 110
			)
		);
	}

	public function setSettings()
	{
		$args[] = array(
			'option_group' => 'basic_plugin_settings',
			'option_name' => 'basic_plugin',
			'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
		);

		$this->settings->setSettings($args);
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'basic_admin_index',
				'title' => 'Settings Managers',
				'callback' => array($this->callbacks_mngr, 'adminSectionManager'),
				'page' => 'basic_plugin_menu_slug'
			)
		);

		$this->settings->setSections($args);
	}

	public function setFields()
	{
		$args = array();

		foreach ($this->managers as $key => $value) {
			$args[] = array(
				'id' => $key,
				'title' => $value,
				'callback' => array($this->callbacks_mngr, 'checkboxField'),
				'page' => 'basic_plugin_menu_slug',
				'section' => 'basic_admin_index',
				'args' => array(
					'option_name' => 'basic_plugin',
					'label_for' => $key,
					'class' => 'ui-toggle'
				)
			);
		}

		$this->settings->setFields($args);
	}

}