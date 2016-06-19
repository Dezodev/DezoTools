<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://dezodev.tk/
 * @since      0.0.1
 *
 * @package    Dezo_Tools
 * @subpackage Dezo_Tools/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dezo_Tools
 * @subpackage Dezo_Tools/public
 * @author     dezodev <dezodev@gmail.com>
 */
class Dezo_Tools_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// Set image size
		add_image_size( 'dezo-one-news', 345, 140, array( 'center', 'center' ) );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {
			// Plugin Style
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dezo-tools-public.css', array(), $this->version, 'all' );
        
			// Lightbox Style
		wp_enqueue_style( 'swipebox-style', plugin_dir_url( __FILE__ ) . 'css/swipebox.min.css', array(), $this->version, 'all' );

			// Grids Style
		wp_enqueue_style( 'dezo-grids-style', 'http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css', array(), '0.6.0', 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {
			//Plugin Script
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dezo-tools-public.js', array( 'jquery' ), $this->version, false );
		
			// Cookie Display
		wp_enqueue_script('jquery-cookie', plugin_dir_url( __FILE__ ) . 'js/js.cookie.js', array( 'jquery' ), '1.4.1', true);
		wp_register_script('cookie-pop-script', plugin_dir_url( __FILE__ ) . 'js/cookie-pop.js', array( 'jquery', 'jquery-cookie' ), '1.0.0', true);
		wp_localize_script( 'cookie-pop-script', 'dezo_cookie_pop_text', array(
				'message' => __( 'This website uses cookies to ensure you get the best experience on our website.', 'dezo-tools' ),
				'button'  => __( 'OK', 'dezo-tools' ),
				'more'    => __( 'More info', 'dezo-tools' )
			)
		);
		
		$cookieDisplay = $this->plugin_name.'_cookie_display';
		if (get_option( $cookieDisplay )) {
			wp_enqueue_script( 'cookie-pop-script' );
		} else {
			wp_dequeue_script( 'cookie-pop-script' );
		}
        
            // Lightbox Display
		wp_enqueue_script('jquery-swipebox', plugin_dir_url( __FILE__ ) . 'js/jquery.swipebox.min.js', array( 'jquery' ), '1.4.1', true);
		wp_register_script('swipebox-script', plugin_dir_url( __FILE__ ) . 'js/swipebox.js', array( 'jquery' ), '1.0.0', true);        
        
		$swipeboxDisplay = $this->plugin_name.'_swipebox_display';        
		if (get_option( $swipeboxDisplay )) {
			wp_enqueue_script( 'swipebox-script' );
		} else {
			wp_dequeue_script( 'swipebox-script' );
		}	
	}

}
