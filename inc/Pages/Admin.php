<?php
/**
 * @package  BasicPlugin
 */
namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

/**
 * 
 */
class Admin extends BaseController
{

	public $settings;
	public $pages = array();
	public $subpages = array();

	public function __construct()
	{
		$this->settings = new SettingsApi();

		$this->pages = array(
			array(
				'page_title' => 'Basic Plugin', 
				'menu_title' => 'Basic Menu Title', 
				'capability' => 'manage_options', 
				'menu_slug' => 'basic_plugin_menu_slug', 
				'callback' => function() { echo '<h1>Basic Plugin</h1>'; }, 
				'icon_url' => 'dashicons-store', 
				'position' => 110
			),
			array(
				'page_title' => 'Basic Plugin 2', 
				'menu_title' => 'Basic Menu Title 2', 
				'capability' => 'manage_options', 
				'menu_slug' => 'basic_plugin_menu_slug_2', 
				'callback' => function() { echo '<h1>Basic Plugin 2</h1>'; }, 
				'icon_url' => 'dashicons-store', 
				'position' => 110
			)
		);

		$this->subpages = array(
			array(
				'parent_slug' => 'basic_plugin_menu_slug', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_cpt', 
				'callback' => function() { echo '<h1>CPT Manager</h1>'; }
			),
			array(
				'parent_slug' => 'basic_plugin_menu_slug', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_taxonomies', 
				'callback' => function() { echo '<h1>Taxonomies Manager</h1>'; }
			),
			array(
				'parent_slug' => 'basic_plugin_menu_slug_2', 
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_widgets', 
				'callback' => function() { echo '<h1>Widgets Manager</h1>'; }
			)
		);
	}

	public function register()
	{

		// add_action('admin_menu', array($this, 'add_admin_pages'));
		// $this->settings->addPages( $this->pages )->register();
		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	// public function add_admin_pages() {
	// 	add_menu_page( 'Basic Plugin Page Title', 'Basic Plugin Menu Title', 'manage_options', 'basic_plugin_menu_slug', array( $this, 'admin_index' ), 'dashicons-store', 110 );
	// }

	public function admin_index() {
		// require_once PLUGIN_PATH . 'templates/admin.php';
		// echo $this->plugin_path;
		require_once $this->plugin_path . 'templates/admin.php';

		// require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
	}

}