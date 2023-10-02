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

		function __construct($string)
		{
			echo $string;
			// add_action('init', array($this, 'custom_post_type'));
			// $this->create_post_type();
		}

		// Non-static method
		// public function register() {
		// 	add_action('admin_enqueue_scripts', array($this, 'enqueue'));
		// }

		// Static method
		public static function register()
		{
			add_action('admin_enqueue_scripts', array('BasicPlugin', 'enqueue'));
		}

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
			require_once plugin_dir_path(__FILE__) . 'inc/basic-wordpress-plugin-activate.php';
			BasicPluginActivate::activate();
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
	require_once plugin_dir_path( __FILE__ ) . 'inc/basic-wordpress-plugin-deactivate.php';
	register_deactivation_hook( __FILE__, array( 'BasicPluginDeactivate', 'deactivate' ) );

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
	BasicPlugin::register();
}

$secondClass = new SecondClass('Second Initialize!');
$secondClass->register_post_type();

//  register_activation_hook(__FILE__, array($basicPlugin, 'activate'));
//  register_deactivation_hook(__FILE__, array($basicPlugin, 'deactivate'));
//  register_uninstall_hook(__FILE__, array($basicPlugin, 'uninstall'));