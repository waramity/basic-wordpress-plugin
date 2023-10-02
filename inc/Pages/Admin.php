<?php
/**
 * @package  BasicPlugin
 */
namespace Inc\Pages;

use \Inc\Base\BaseController;

/**
 * 
 */
class Admin extends BaseController
{

	// function __construct()
	// {
	// }

	public function register()
	{

		add_action('admin_menu', array($this, 'add_admin_pages'));

	}

	public function add_admin_pages() {
		add_menu_page( 'Basic Plugin Page Title', 'Basic Plugin Menu Title', 'manage_options', 'basic_plugin_menu_slug', array( $this, 'admin_index' ), 'dashicons-store', 110 );
	}

	public function admin_index() {
		// require_once PLUGIN_PATH . 'templates/admin.php';
		// echo $this->plugin_path;
		require_once $this->plugin_path . 'templates/admin.php';

		// require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
	}

}