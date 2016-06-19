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
 * Description:       Dezo Tools est un plugin tous en un pour ameliorer votre wordpress.
 * Version:           0.0.2
 * Author:            dezodev
 * Author URI:        http://dezodev.tk/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dezo-tools
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dezo-tools-activator.php
 */
function activate_dezo_tools() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dezo-tools-activator.php';
	Dezo_Tools_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dezo-tools-deactivator.php
 */
function deactivate_dezo_tools() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dezo-tools-deactivator.php';
	Dezo_Tools_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dezo_tools' );
register_deactivation_hook( __FILE__, 'deactivate_dezo_tools' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dezo-tools.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.1
 */
function run_dezo_tools() {

	$plugin = new Dezo_Tools();
	$plugin->run();

}
run_dezo_tools();
