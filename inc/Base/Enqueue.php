<?php 
/**
 * @package  BasicPlugin
 */
namespace Inc\Base;

use \Inc\Base\BaseController;


/**
* 
*/
class Enqueue extends BaseController
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}
	
	function enqueue() {
		// enqueue all our scripts
		// wp_enqueue_style( 'plugin_style', PLUGIN_URL . 'assets/style.css' );
		// wp_enqueue_script( 'plugin__script', PLUGIN_URL . 'assets/script.js' );
		wp_enqueue_style( 'plugin_style', $this->plugin_url . 'assets/style.css' );
		wp_enqueue_script( 'plugin_script', $this->plugin_url . 'assets/script.js' );
	}
}