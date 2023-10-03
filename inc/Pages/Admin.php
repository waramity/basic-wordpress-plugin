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
class Admin extends BaseController
{

	public $settings;
	public $callbacks;
	public $callbacks_mngr;
	public $pages = array();
	public $subpages = array();

	public function register()
	{

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();

		// add_action('admin_menu', array($this, 'add_admin_pages'));
		// $this->settings->addPages( $this->pages )->register();
		$this->setPages();
		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
	}

	// public function add_admin_pages() {
	// 	add_menu_page( 'Basic Plugin Page Title', 'Basic Plugin Menu Title', 'manage_options', 'basic_plugin_menu_slug', array( $this, 'admin_index' ), 'dashicons-store', 110 );
	// }
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

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'basic_plugin_menu_slug',
				'page_title' => 'Custom Post Types',
				'menu_title' => 'CPT',
				'capability' => 'manage_options',
				'menu_slug' => 'basic_cpt',
				'callback' => array($this->callbacks, 'adminCpt')
			),
			array(
				'parent_slug' => 'basic_plugin_menu_slug',
				'page_title' => 'Custom Taxonomies',
				'menu_title' => 'Taxonomies',
				'capability' => 'manage_options',
				'menu_slug' => 'basic_taxonomies',
				'callback' => array($this->callbacks, 'adminTaxonomy')
			),
			array(
				'parent_slug' => 'basic_plugin_menu_slug',
				'page_title' => 'Custom Widgets',
				'menu_title' => 'Widgets',
				'capability' => 'manage_options',
				'menu_slug' => 'basic_widgets',
				'callback' => array($this->callbacks, 'adminWidget')
			)
		);
	}

	public function setSettings()
	{
		// $args = array();
		// var_dump($this->managers);
		// var_dump($this->plugin_path);

		// foreach ($this->managers as $key => $value) {
		// 	$args[] = array(
		// 		'option_group' => 'basic_plugin_settings',
		// 		'option_name' => $key,
		// 		'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
		// 	);
		// }

		$args[] = array(
			'option_group' => 'basic_plugin_settings',
			'option_name' => 'basic_plugin',
			'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
		);

		// $args = array(
		// 	array(
		// 		'option_group' => 'basic_plugin_settings',
		// 		'option_name' => 'cpt_manager',
		// 		'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
		// 	),
		// 	array(
		// 		'option_group' => 'basic_plugin_settings',
		// 		'option_name' => 'taxonomy_manager',
		// 		'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
		// 	),
		// 	array(
		// 		'option_group' => 'basic_plugin_settings',
		// 		'option_name' => 'media_widget',
		// 		'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
		// 	),
		// 	array(
		// 		'option_group' => 'basic_plugin_settings',
		// 		'option_name' => 'gallery_manager',
		// 		'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
		// 	),
		// 	array(
		// 		'option_group' => 'basic_plugin_settings',
		// 		'option_name' => 'testimonial_manager',
		// 		'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
		// 	),
		// 	array(
		// 		'option_group' => 'basic_plugin_settings',
		// 		'option_name' => 'templates_manager',
		// 		'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
		// 	),
		// 	array(
		// 		'option_group' => 'basic_plugin_settings',
		// 		'option_name' => 'login_manager',
		// 		'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
		// 	),
		// 	array(
		// 		'option_group' => 'basic_plugin_settings',
		// 		'option_name' => 'membership_manager',
		// 		'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
		// 	),
		// 	array(
		// 		'option_group' => 'basic_plugin_settings',
		// 		'option_name' => 'chat_manager',
		// 		'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
		// 	)
		// );

		$this->settings->setSettings($args);
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'basic_admin_index',
				'title' => 'Settings Managers',
				// 'callback' => array($this->callbacks, 'basicAdminSection'),
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

	public function admin_index()
	{
		// require_once PLUGIN_PATH . 'templates/admin.php';
		// echo $this->plugin_path;
		require_once $this->plugin_path . 'templates/admin.php';

		// require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
	}

}