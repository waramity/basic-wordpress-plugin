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

// defined('PLUGIN_PATH', plugin_dir_path(__FILE__));
// define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
// define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
// define( 'PLUGIN', plugin_basename( __FILE__ ) );

// use Inc\Base\Activate;
// use Inc\Base\Deactivate;

/**
 * The code that runs during plugin activation
 */
function activate_basic_plugin() {
	// Activate::activate();
	Inc\Base\Activate::activate();
}

/**
 * The code that runs during plugin deactivation
 */
function deactivate_basic_plugin() {
	// Deactivate::deactivate();
	Inc\Base\Deactivate::deactivate();
}

register_activation_hook( __FILE__, 'activate_basic_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_basic_plugin' );


if ( class_exists('Inc\\Init') ) {
	Inc\Init::register_services();
}