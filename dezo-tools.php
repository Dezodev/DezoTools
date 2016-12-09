<?php


/**
 *
 * @link              http://dezodev.tk/
 * @since             0.0.1
 * @package           Dezo_Tools
 *
 * @wordpress-plugin
 * Plugin Name:       DezoTools
 * Plugin URI:        http://dezodev.tk/dezo-tools
 * Description:       Dezo Tools is a plugin all in one to improve your wordpress.
 * Version:           0.1.0
 * Author:            dezodev
 * Author URI:        http://dezodev.tk/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dezo-tools
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

// Load constants
require_once dirname( __FILE__ ).'/includes/dezo-tools-const.php';
$dezo_const = dezo_get_const();

// Register Actions
register_activation_hook(__FILE__, 'dezo_activation');
register_deactivation_hook(__FILE__, 'dezo_desactivation');
add_action( 'init', 'dezo_init', 0 );
add_action('plugins_loaded', 'dezo_load_textdomain');

function dezo_tools(){
	$dezo_const = dezo_get_const();

    // Start a PHP session, if not yet started
	if ( ! session_id() ) session_start();

	// Load Options
	if ( ! class_exists( 'dezo_tools_admin' ) ) {
		require_once $dezo_const->dir.'includes/class-dezo_tools-admin.php';
		new dezo_tools_admin;
	}

    // Load Class Dezo-tools
	if ( ! class_exists( 'dezo_tools' ) ) {
		require_once $dezo_const->dir.'includes/class-dezo_tools.php';
        new dezo_tools();
	}

	// Load Class Dezo-tools Maintenance
	if ( ! class_exists( 'dezo_tools_maintenance' ) ) {
		require_once $dezo_const->dir.'includes/class-dezo_tools-maintenance.php';
        new dezo_tools_maintenance();
	}

	// Load Dezo-tools Minify
	require_once $dezo_const->dir.'includes/dezo_tools-minify-html.php';
}

function dezo_init(){
	$dezo_const = dezo_get_const();

	require_once $dezo_const->dir.'includes/dezo-scripts.php';
}

function dezo_activation(){
	dezo_tools_admin::setup_default_options();
}

function dezo_desactivation(){

}

function dezo_load_textdomain() {
	load_plugin_textdomain( 'dezo-tools', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

// Run start function
dezo_tools();
