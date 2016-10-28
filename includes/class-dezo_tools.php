<?php

/**
 * Main class
 */
class dezo_tools
{

    private $dezo_const=null;

    /**
     * Class constructor
     *
     * @since 0.1.0
     */
    function __construct(){

        // Load constants
        require_once dirname( __FILE__ ).'/dezo-tools-const.php';
        $this->dezo_const  = dezo_get_const();

        // Register actions
        add_action('login_head', array($this, 'dezo_custom_login_logo')); // Put custom logo on WP login page
		add_action('wp_head', array($this, 'dezo_custom_header')); // Add custom code to the header
        add_action('wp_footer', array($this, 'dezo_custom_footer')); // Add custom code to the footer

        // Add shortcodes
        add_shortcode( 'dezo-all-news', array($this, 'dezo_all_news_shortcode') ); // Shortcodes for display articles

        // Add images size
		add_image_size( 'dezo-one-news', 345, 140, array( 'center', 'center' ) );
    }

    /**
     * Add custom logo to WP login page
     *
     * @return void
     * @since 0.1.0
     */
    public function dezo_custom_login_logo() {
		if (get_option($this->dezo_const->shortname.'_logo_in_login') == 1) {
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
     * Add custom code to the header
     *
     * @return void
     * @since 0.1.0
     */
    public function dezo_custom_header(){
		if (get_option($this->dezo_const->shortname.'_header_code') != null) {
			echo get_option($this->dezo_const->shortname.'_header_code');
		}
	}

    /**
     * Add custom code to the footer
     *
     * @return void
     * @since 0.1.0
     */
	public function dezo_custom_footer(){
		if (get_option($this->dezo_const->shortname.'_footer_code') != null) {
			echo get_option($this->dezo_const->shortname.'_footer_code');
		}
	}

    /**
     * Shortcodes for display articles
     *
     * @return string html code
     * @since 0.1.0
     */
    public function dezo_all_news_shortcode(){
		// Init vars
		$content = '';

        // Get posts lists (Default: 4 articles)
		$args = array (
			'post_status'            => array( 'publish' ),
			'nopaging'               => false,
			'posts_per_page'         => '4',
			'ignore_sticky_posts'    => false,
		);
		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {
			$content .= '<div class="pure-g">';

			while ( $query->have_posts() ) {
				$query->the_post();

				// Display the news
				$content .= '<div class="dezo-one-news pure-u-1 pure-u-sm-1-2 l-box">';
                $content .= '<div class="dezo-content-news">';
                $content .= '<a href="'.get_permalink().'">';

				if (get_the_post_thumbnail($post, 'dezo-one-news') != '') {
					$content .= get_the_post_thumbnail($post, 'dezo-one-news');
				} else {
					$content .= '<div class="dezo-img-placeholder"></div>';
				}

				$content .= '<h3>'.get_the_title().'</h3></a>';
				$content .= '<p>'.get_the_excerpt().'</p>';
				$content .= '</div> </div>';
			}

			$content .= '</div>';
		} else {
			$content .= "";
		}

		// Restore original Post Data
		wp_reset_postdata();

		return $content;
    }

}
