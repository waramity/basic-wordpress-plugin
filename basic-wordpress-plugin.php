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

 if(!function_exists('add_actions')) {
	echo 'You have\'nt permission to access this file.';
	exit;	
 }