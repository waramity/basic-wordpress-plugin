<?php
/*
 * Plugin Name:       Basic Plugin 
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            waramity 
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/basic-wordpress-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

//  if(!defined('ABSPATH')) {
// 	die;
//  }

defined('ABSPATH') or die('You have\'nt permission to access this file.');

//  if(!function_exists('add_actions')) {
// 	echo 'You have\'nt permission to access this file.';
// 	exit;	
//  }

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

use Inc\Activate;
// use Inc\Deactivate;
// use Inc\Admin\AdminPages;

if (!class_exists('AlecadddPlugin')) {

	class BasicPlugin
	{

		// Public
		// can be accessed everywhere

		// Protected
		// can be accessed only within the class itself or extensions of that class

		// Private 
		// can be accessed only within the class itself

		// Static

		protected $array1 = array();
		public $plugin;

		function __construct($string)
		{
			echo $string;
			// add_action('init', array($this, 'custom_post_type'));
			// $this->create_post_type();
			$this->plugin = plugin_basename( __FILE__ );
		}

		// Non-static method
		public function register() {
			add_action('admin_enqueue_scripts', array($this, 'enqueue'));

			add_action('admin_menu', array ($this, 'add_admin_pages'));

			add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
		}
		public function settings_link( $links ) {
			$settings_link = '<a href="admin.php?page=basic_plugin_menu_slug">Settings</a>';
			array_push( $links, $settings_link );
			return $links;
		}

		public function add_admin_pages() {
			add_menu_page( 'Basic Plugin Page Title', 'Basic Plugin Menu Title', 'manage_options', 'basic_plugin_menu_slug', array( $this, 'admin_index' ), 'dashicons-store', 110 );
		}

		public function admin_index() {
			require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
		}

		// Static method
		// public static function register()
		// {
		// 	add_action('admin_enqueue_scripts', array('BasicPlugin', 'enqueue'));

		// }

		protected function create_post_type()
		{
			add_action('init', array($this, 'custom_post_type'));
		}

		// function activate() {
		// 	echo 'Basic plugin is activated.';
		// 	$this->custom_post_type();
		// 	flush_rewrite_rules();
		// }

		function activate()
		{
			// require_once plugin_dir_path(__FILE__) . 'inc/basic-wordpress-plugin-activate.php';
			// BasicPluginActivate::activate();
			Activate::activate();
		}

		// function deactivate()
		// {
		// 	echo 'Basic plugin is deactivated.';
		// 	flush_rewrite_rules();
		// }


		function custom_post_type()
		{
			register_post_type('book', ['public' => true, 'label' => 'Books']);
		}

		// Non-static method
		// function enqueue() {
		// 	wp_enqueue_style('plugin_style', plugins_url('/assets/style.css', __FILE__));
		// 	wp_enqueue_script('plugin_script', plugins_url('/assets/script.js', __FILE__));
		// }

		// Static method
		static function enqueue()
		{
			wp_enqueue_style('plugin_style', plugins_url('/assets/style.css', __FILE__));
			wp_enqueue_script('plugin_script', plugins_url('/assets/script.js', __FILE__));
		}
	}

	$basicPlugin = new BasicPlugin('Basic Plugin Initialized!');
	$basicPlugin->register();

	// activation
	register_activation_hook( __FILE__, array( $basicPlugin, 'activate' ) );

	// deactivation
	// require_once plugin_dir_path( __FILE__ ) . 'inc/basic-wordpress-plugin-deactivate.php';
	// register_deactivation_hook( __FILE__, array( 'BasicPluginDeactivate', 'deactivate' ) );
	register_deactivation_hook( __FILE__, array( 'Inc\Deactivate', 'deactivate' ) );


}


class SecondClass extends BasicPlugin
{
	function register_post_type()
	{
		$this->create_post_type();
	}
}

if (class_exists('BasicPlugin')) {
	// Non-static method
	// $basicPlugin = new BasicPlugin('Basic Plugin Initialize!');
	// $basicPlugin->register();
	// Static method
	// BasicPlugin::register();
}

// $secondClass = new SecondClass('Second Initialize!');
// $secondClass->register_post_type();

//  register_activation_hook(__FILE__, array($basicPlugin, 'activate'));
//  register_deactivation_hook(__FILE__, array($basicPlugin, 'deactivate'));
//  register_uninstall_hook(__FILE__, array($basicPlugin, 'uninstall'));