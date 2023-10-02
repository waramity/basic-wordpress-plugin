<?php
/**
 * @package  BasicPlugin
 */
namespace Inc\Pages;

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
	public $pages = array();
	public $subpages = array();

	public function __construct()
	{
	}

	public function register()
	{

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();

		// add_action('admin_menu', array($this, 'add_admin_pages'));
		// $this->settings->addPages( $this->pages )->register();
		$this->setPages();
		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	// public function add_admin_pages() {
	// 	add_menu_page( 'Basic Plugin Page Title', 'Basic Plugin Menu Title', 'manage_options', 'basic_plugin_menu_slug', array( $this, 'admin_index' ), 'dashicons-store', 110 );
	// }
	public function setPages(){
		$this->pages = array(
			array(
				'page_title' => 'Basic Plugin', 
				'menu_title' => 'Basic Menu Title', 
				'capability' => 'manage_options', 
				'menu_slug' => 'basic_plugin_menu_slug', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-store', 
				'position' => 110
			)		
		);
	}

	public function setSubpages(){
		$this->subpages = array(
			array(
				'parent_slug' => 'basic_plugin_menu_slug', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_cpt', 
				'callback' => array( $this->callbacks, 'adminCpt' )
			),
			array(
				'parent_slug' => 'basic_plugin_menu_slug', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_taxonomies', 
				'callback' => array( $this->callbacks, 'adminTaxonomy' )
			),
			array(
				'parent_slug' => 'basic_plugin_menu_slug', 
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_widgets', 
				'callback' => array( $this->callbacks, 'adminWidget' )
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'basic_options_group',
				'option_name' => 'text_example',
				'callback' => array( $this->callbacks, 'basicOptionsGroup' )
			),
			array(
				'option_group' => 'basic_options_group',
				'option_name' => 'first_name'
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'basic_admin_index',
				'title' => 'Settings',
				'callback' => array( $this->callbacks, 'basicAdminSection' ),
				'page' => 'basic_plugin_menu_slug'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array(
			array(
				'id' => 'text_example',
				'title' => 'Text Example',
				'callback' => array( $this->callbacks, 'basicTextExample' ),
				'page' => 'basic_plugin_menu_slug',
				'section' => 'basic_admin_index',
				'args' => array(
					'label_for' => 'text_example',
					'class' => 'example-class'
				)
			),
			array(
				'id' => 'first_name',
				'title' => 'First Name',
				'callback' => array( $this->callbacks, 'basicFirstName' ),
				'page' => 'basic_plugin_menu_slug',
				'section' => 'basic_admin_index',
				'args' => array(
					'label_for' => 'first_name',
					'class' => 'example-class'
				)
			)
		);

		$this->settings->setFields( $args );
	}

	public function admin_index() {
		// require_once PLUGIN_PATH . 'templates/admin.php';
		// echo $this->plugin_path;
		require_once $this->plugin_path . 'templates/admin.php';

		// require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
	}

}