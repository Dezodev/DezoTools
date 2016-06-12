<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://dezodev.tk/
 * @since      0.0.1
 *
 * @package    Dezo_Tools
 * @subpackage Dezo_Tools/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.0.1
 * @package    Dezo_Tools
 * @subpackage Dezo_Tools/includes
 * @author     dezodev <dezodev@gmail.com>
 */
class Dezo_Tools_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.0.1
	 */
	public function load_plugin_textdomain() {
        
		load_plugin_textdomain(
			'dezo-tools',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
