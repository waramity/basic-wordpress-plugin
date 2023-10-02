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

 class BasicPlugin 
 {
	function __construct($string) {
		echo $string;
		add_action('init', array($this, 'custom_post_type'));
	}

	function register() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue'));
	}

	function activate() {
		echo 'Basic plugin is activated.';
		$this->custom_post_type();
		flush_rewrite_rules();
	}

	function deactivate() {
		echo 'Basic plugin is deactivated.';
		flush_rewrite_rules();
	}

	function custom_post_type() {
		register_post_type('book', ['public' => true, 'label' => 'Books']);
	}

	function enqueue() {
		wp_enqueue_style('plugin_style', plugins_url('/assets/style.css', __FILE__));
		wp_enqueue_script('plugin_script', plugins_url('/assets/script.js', __FILE__));
	}
 }

 if(class_exists('BasicPlugin')) {
 	$basicPlugin = new BasicPlugin('Basic Plugin Initialize!');
	$basicPlugin->register();
 }

 register_activation_hook(__FILE__, array($basicPlugin, 'activate'));
 register_deactivation_hook(__FILE__, array($basicPlugin, 'deactivate'));
 register_uninstall_hook(__FILE__, array($basicPlugin, 'uninstall'));