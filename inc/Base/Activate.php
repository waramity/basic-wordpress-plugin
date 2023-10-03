<?php
/**
 * @package  BasicPlugin
 */
namespace Inc\Base;

class Activate
{
	public static function activate()
	{
		flush_rewrite_rules();

		if (get_option('basic_plugin')) {
			return;
		}

		$default = array();

		update_option('basic_plugin', $default);
	}
}