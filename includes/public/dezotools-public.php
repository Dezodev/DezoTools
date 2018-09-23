<?php

/**
 * Dezo Tools Public class
 */
class dezoTools_Public
{
    /**
     * Constructor
     */
    public function __construct() {
        // Add tracking code
        $this->add_action('wp_head', 'insert_ga_tracking_code');

        // Add code in header
        $this->add_action('wp_head', 'custom_header');

        // Add code in footer
        $this->add_action('wp_footer', 'custom_footer');

        // Add plugin scripts
        $this->add_action( 'wp_enqueue_scripts', 'plugin_scripts' );;

        // Remove wordpress header details
        $val_hide_wp = get_option('dezo-hide-wp-header-details');
        if ($val_hide_wp === '1') $this->add_action('init', 'hide_wordpress');

        // Disable emojis
        $val_emojis = get_option('dezo-disable-emojis');
        if ($val_emojis === '1') $this->add_action('init', 'disable_emojis');
    }

    /*-- Plugin actions --*/

    public function insert_ga_tracking_code() {
        $gaID = get_option('dezo-ganalytics-id');

        if (!empty($gaID)) {
            ?>
                <!-- Global site tag (gtag.js) - Google Analytics -->
                <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $gaID; ?>"></script>
                <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', '<?php echo $gaID; ?>');
                </script>

            <?php
        }
    }

    public function custom_header() {
        $code = get_option('dezo-custom-header');

        if (!empty($code)) {
            echo $code."\r\n";
        }
    }

    public function custom_footer() {
        $code = get_option('dezo-custom-footer');

        if (!empty($code)) {
            echo $code."\r\n";
        }
    }

    public function hide_wordpress() {
        // Remove Actions
        remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
        remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
        remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
        remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
        remove_action('wp_head', 'index_rel_link'); // Index link
        remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
        remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
        remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
        remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        remove_action('wp_head', 'rel_canonical');
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    }

    public function disable_emojis() {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        add_filter('tiny_mce_plugins', [&$this, 'disable_emojis_tinymce']);
        add_filter( 'wp_resource_hints', [&$this, 'disable_emojis_remove_dns_prefetch'], 10, 2 );
    }


    /**
     * Filter function used to remove the tinymce emoji plugin.
     *
     * @param array $plugins
     * @return array Difference betwen the two arrays
     */
    function disable_emojis_tinymce($plugins) {
        if (is_array($plugins)) {
            return array_diff($plugins, array( 'wpemoji' ));
        } else {
            return array();
        }
    }


    /**
     * Remove emoji CDN hostname from DNS prefetching hints.
     *
     * @param array $urls URLs to print for resource hints.
     * @param string $relation_type The relation type the URLs are printed for.
     * @return array Difference betwen the two arrays.
     */
    function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
        if ( 'dns-prefetch' == $relation_type ) {
            /** This filter is documented in wp-includes/formatting.php */
            $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

            $urls = array_diff( $urls, array( $emoji_svg_url ) );
        }
        return $urls;
    }

    /**
     * Function for register styles and scripts for this plugins (in public)
     *
     * @return void
     */
    public function plugin_scripts() {
        $enable_lightbox = get_option('dezo-enable-lightbox');
        $enable_lightbox = ($enable_lightbox == '1') ? true : false;

        /* -- CSS -- */
        $css_includes = [
            [
                'name'          => 'dezotools-simpleLightbox-css',
                'url'           => DEZOTOOLS_URI. 'assets/public/simplelightbox/simplelightbox.min.css',
                'dependencies'  => false,
                'version'       => '1.13.0',
                'media'         => 'all',
                'active'        => $enable_lightbox,
            ],
            [
                'name'          => 'dezotools-lightbox-css',
                'url'           => DEZOTOOLS_URI. 'assets/public/css/dezotools-lightbox.min.css',
                'dependencies'  => array('dezotools-simpleLightbox-css'),
                'version'       => DEZOTOOLS_VER,
                'media'         => 'all',
                'active'        => $enable_lightbox,
            ],
        ];

        foreach ($css_includes as $css_include) {
            if ($css_include['active'] === true) {
                wp_register_style( $css_include['name'], $css_include['url'], $css_include['dependencies'], $css_include['version'], $css_include['media'] );
                wp_enqueue_style( $css_include['name'] );
            }
        }

        /* -- JS -- */
        $js_includes = [
            [
                'name'          => 'dezotools-simpleLightbox-js',
                'url'           => DEZOTOOLS_URI. 'assets/public/simplelightbox/simple-lightbox.min.js',
                'dependencies'  => array('jquery'),
                'version'       => '1.13.0',
                'inFooter'      => true,
                'active'        => $enable_lightbox,
            ],
            [
                'name'          => 'dezotools-lightbox-js',
                'url'           => DEZOTOOLS_URI. 'assets/public/js/dezotools-lightbox.js',
                'dependencies'  => array('jquery', 'dezotools-simpleLightbox-js'),
                'version'       => DEZOTOOLS_VER,
                'inFooter'      => true,
                'active'        => $enable_lightbox,
            ],
        ];

        foreach ($js_includes as $js_include) {
            if ($js_include['active'] === true) {
                wp_register_script( $js_include['name'], $js_include['url'], $js_include['dependencies'], $js_include['version'], $js_include['inFooter'] );
                wp_enqueue_script( $js_include['name'] );
            }
        }
    }

    /*-- Plugin helpers --*/

    /**
     * Helper method for register actions
     *
     * @return void
     */
    private function add_action($action, $fn, $priority = 10, $accepted_args = 1) {
        add_action($action, array(&$this, $fn), $priority, $accepted_args);
    }
}
