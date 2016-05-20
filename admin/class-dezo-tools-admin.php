<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://dezodev.tk/
 * @since      0.0.1
 *
 * @package    Dezo_Tools
 * @subpackage Dezo_Tools/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dezo_Tools
 * @subpackage Dezo_Tools/admin
 * @author     dezodev <dezodev@gmail.com>
 */
class Dezo_Tools_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		add_action( 'admin_menu', array($this, 'dezotools_admin_menu') );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dezo-tools-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dezo-tools-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Add the setting page to the wordpress
	 *
	 * @since    0.0.1
	 */
	public function dezotools_admin_menu() {
		add_menu_page( 'DezoTools > Réglages', 'DezoTools', 'manage_options', 'dezotools-admin-page', array($this, 'dezotools_admin_page'), 'dashicons-admin-tools', 99 );
	}
	
	/**
	 * Add content to the setting page
	 *
	 * @since    0.0.1
	 */
	public function dezotools_admin_page(){
		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/dezo-tools-admin-display.php';
	}

}
