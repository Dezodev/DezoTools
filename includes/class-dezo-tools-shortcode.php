<?php

/**
 * Fired in shortcode call
 *
 * @link       http://dezodev.tk/
 * @since      0.0.1
 *
 * @package    Dezo_Tools
 * @subpackage Dezo_Tools/includes
 */

/**
 * Fired in shortcode call
 *
 * Fired in shortcode call
 *
 * @since      0.0.1
 * @package    Dezo_Tools
 * @subpackage Dezo_Tools/includes
 * @author     dezodev <dezodev@gmail.com>
 */
class Dezo_Tools_Shortcode {

    public function __construct() {

		// Add Shortcode
        add_shortcode( 'dezo-all-news', array($this, 'dezo_all_news_shortcode') );

	}
    
	/**
     * Shortcode for display all articles 
     *
	 * @since    0.0.1
	 */
	public static function dezo_all_news_shortcode() {
		//Variable
		$content = '';

		// WP_Query arguments
		$args = array (
			'post_status'            => array( 'publish' ),
			'nopaging'               => false,
			'posts_per_page'         => '4',
			'ignore_sticky_posts'    => false,
		);

		// The Query
		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {
			$content .= '<div class="pure-g">';

			while ( $query->have_posts() ) {
				$query->the_post();
				
				// Display the news
				$content .= '<div class="dezo-one-news pure-u-1 pure-u-sm-1-2 l-box">
								<div class="dezo-content-news">
									<a href="'.get_permalink().'">';
				
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