<?php
/**
 * @package  BasicPlugin
 */

class BasicPluginDeactivate
{
	public static function deactivate() {
		echo 'Basic plugin is deactivated.';
		flush_rewrite_rules();
	}
}