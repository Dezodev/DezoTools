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
		
		$update = 0;
		
		// Saving Data
			// Fields name
		$logoInLogin = $this->plugin_name.'_logo_in_login';
		$cookieDisplay = $this->plugin_name.'_cookie_display';
		$swipeboxDisplay = $this->plugin_name.'_swipebox_display';
		$headerCode = $this->plugin_name.'_header_code';
		$footerCode = $this->plugin_name.'_footer_code';
		$postRevision = $this->plugin_name.'_num_post_revision';
		$postInterval = $this->plugin_name.'_post_revision';
		
			// Display cookie information
		if (isset($_POST[$cookieDisplay]) && isset($_POST['token']) ) {
			if(get_option($cookieDisplay) != $_POST[$cookieDisplay]){
				$update++;
			}
			update_option($cookieDisplay, $_POST[$cookieDisplay]);
		} elseif (!isset($_POST[$cookieDisplay]) && isset($_POST['token']) && 1 == get_option($cookieDisplay)) {
			update_option($cookieDisplay, 0);
		}
			// Display lightbox
		if (isset($_POST[$swipeboxDisplay]) && isset($_POST['token']) ) {
			if(get_option($swipeboxDisplay) != $_POST[$swipeboxDisplay]){
				$update++;
			}
			update_option($swipeboxDisplay, $_POST[$swipeboxDisplay]);
		} elseif (!isset($_POST[$swipeboxDisplay]) && isset($_POST['token']) && 1 == get_option($swipeboxDisplay)) {
			update_option($swipeboxDisplay, 0);
		}
			// Site logo in login page
		if (isset($_POST[$logoInLogin]) && isset($_POST['token']) ) {
			if(get_option($logoInLogin) != $_POST[$logoInLogin]){
				$update++;
			}
			update_option($logoInLogin, $_POST[$logoInLogin]);
		} elseif (!isset($_POST[$logoInLogin]) && isset($_POST['token']) && 1 == get_option($logoInLogin)) {
			update_option($logoInLogin, 0);
		}
		
			// Custom code to header
		if (isset($_POST[$headerCode]) && isset($_POST['token']) ) {
			if(get_option($headerCode) != $_POST[$headerCode]){
				$update++;
			}
			update_option($headerCode, stripslashes($_POST[$headerCode]));
		} elseif (!isset($_POST[$headerCode]) && isset($_POST['token'])) {
			update_option($headerCode, '');
		}
		
			// Custom code to footer
		if (isset($_POST[$footerCode]) && isset($_POST['token']) ) {
			if(get_option($footerCode) != $_POST[$footerCode]){
				$update++;
			}
			update_option($footerCode, stripslashes($_POST[$footerCode]));
		} elseif (!isset($_POST[$footerCode]) && isset($_POST['token'])) {
			update_option($footerCode, '');
		}
		
			// Limitation of the number of revision
		if (isset($_POST[$postRevision]) && isset($_POST['token']) ) {
			if(get_option($postRevision) != $_POST[$postRevision]){
				$update++;
			}
			update_option($postRevision, $_POST[$postRevision]);
		} elseif (!isset($_POST[$postRevision]) && isset($_POST['token'])) {
			update_option($postRevision, '');
		}
		
			// Post auto-save interval
		if (isset($_POST[$postInterval]) && isset($_POST['token']) ) {
			if(get_option($postInterval) != $_POST[$postInterval]){
				$update++;
			}
			update_option($postInterval, $_POST[$postInterval]);
		} elseif (!isset($_POST[$postInterval]) && isset($_POST['token'])) {
			update_option($postInterval, '');
		}
		
		if (isset($_POST['token'])) {
			$this->dezo_after_save();
		}
		
		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/dezo-tools-admin-display.php';
	}
	
	/**
	 * Function to execute action after option save
	 *
	 * @since    0.0.1
	 */
	public function dezo_after_save(){
		
			//Field Name
		$postRevision = $this->plugin_name.'_num_post_revision';
		$postInterval = $this->plugin_name.'_post_revision';
		
		if (get_option($postRevision) != 0) {
			define( 'WP_POST_REVISIONS', get_option($postRevision) );
		}else {
			define( 'WP_POST_REVISIONS', -1);
		}
		
		if (get_option($postInterval) != null) {
			define( 'AUTOSAVE_INTERVAL', get_option($postInterval) );
		}
				
	}

	/**
	 * Add logo to the login page
	 *
	 * @since    0.0.1
	 */
	public function dezo_custom_login_logo() {
		
		if (get_option($this->plugin_name.'_logo_in_login') == 1) {
			echo '<style type="text/css">
				.login h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important; background-size: auto 100%; width: 100%; }
			</style>';
		} else {
			echo '<style type="text/css">
				.login h1 a { background-image: url("'.home_url('/').'wp-admin/images/wordpress-logo.svg?ver=20131107") !important; }
			</style>';
		}
		
		
	}
	
	/**
	 * Add code to site footer
	 *
	 * @since    0.0.1
	 */
	public function dezo_custom_footer()
	{
		if (get_option($this->plugin_name.'_footer_code') != null) {
			echo get_option($this->plugin_name.'_footer_code');
		}
	}
	
	/**
	 * Add code to site header
	 *
	 * @since    0.0.1
	 */
	public function dezo_custom_header()
	{
		if (get_option($this->plugin_name.'_header_code') != null) {
			echo get_option($this->plugin_name.'_header_code');
		}
	}
	
}
