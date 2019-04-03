<?php
/**
 * Dezo Tools start file
 *
 * @link              http://dezodev.tk/
 * @since             0.2.1
 * @package           DezoTools
 *
 * @wordpress-plugin
 * Plugin Name:       Dezo Tools
 * Plugin URI:        http://dezodev.tk/dezo-tools
 * Description:       DezoTools is an all-in-one plugin to improve WordPress
 * Version:           0.2.1
 * Author:            Dezodev
 * Author URI:        http://dezodev.tk/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       dezo-tools
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/Dezodev/dezo-tools
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) die;


if (!class_exists('DezoTools_Main')) {
    /**
    * DezoTools Main class
    */
    class DezoTools_Main {

        /** Constructor **/
        function __construct() {
            $this->add_action('plugins_loaded', 'plugin_loaded', 1);
            $this->add_action('init', 'plugin_init');

            register_activation_hook(__FILE__, array(&$this, 'plugin_activate'));  // On activation of the plugin
			register_deactivation_hook(__FILE__, array(&$this, 'plugin_desactivate')); // On desactivation of the plugin
			// register_uninstall_hook(__FILE__, array(&$this, 'plugin_uninstall')); // On uninstallation of the plugin
        }

        public function plugin_loaded() {
            $this->set_constants(); // Set Constants
            $this->includes(); // Load Functions
        }

        /** Plugin actions **/

        public function plugin_init() {

        }

        public static function plugin_activate() {
            $include_dir = trailingslashit(plugin_dir_path(__FILE__)).trailingslashit('includes');
            require_once $include_dir.'admin/dezotools-admin.php';
            DezoTools_Admin::set_default_options();
        }

        public static function plugin_desactivate() {

        }

        /** Plugin methods **/

        public function set_constants() {
            define('DEZOTOOLS_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) ); // Plugin Directory
			define('DEZOTOOLS_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) ); // Plugin URL
			define('DEZOTOOLS_INCLUDES', DEZOTOOLS_DIR . trailingslashit( 'includes' ) ); // Path to include dir
            define('DEZOTOOLS_VER', '0.2.1' ); // Plugin version
        }

        public function includes() {
            require_once DEZOTOOLS_INCLUDES.'admin/dezotools-admin.php';
            new DezoTools_Admin();

            require_once DEZOTOOLS_INCLUDES.'public/dezotools-public.php';
            new DezoTools_Public();

            require_once DEZOTOOLS_INCLUDES.'public/dezotools-minify.php';
            new dezoTools_Minify();
        }

        /** Plugin helpers **/

        private function add_action($action, $fn, $priority = 10, $accepted_args = 1) {
            add_action($action, array(&$this, $fn), $priority, $accepted_args);
        }
    }
}

$GLOBALS['DezoTools_Main'] = new DezoTools_Main();
