<?php
/**
 * @package  BasicPlugin
 */

class BasicPluginActivate
{
	public static function activate() {
		echo 'Basic plugin is activated.';
		flush_rewrite_rules();
	}
}