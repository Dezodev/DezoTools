<?php
/**
 * Register Script
 */

 // Load constants
require_once dirname( __FILE__ ).'/dezo-tools-const.php';
$dezo_const = dezo_get_const();


function dezo_script_public() {
    $dezo_const = dezo_get_const();

    /* -- JS -- */
    $js_includes = [
        [
            'name'          => 'dezo-script-public',
            'url'           => $dezo_const->uri.'assets/public/js/dezo-tools-public.js',
            'dependencies'  => array('jquery'),
            'version'       => $dezo_const->version,
            'inFooter'      => true
        ],
        [
            'name'          => 'dezo-cookie-script',
            'url'           => 'https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.3/js.cookie.min.js',
            'dependencies'  => array('jquery'),
            'version'       => '2.1.3',
            'inFooter'      => true
        ],
        [
            'name'          => 'dezo-cookie-set',
            'url'           => $dezo_const->uri.'assets/public/js/dezo-cookie.js',
            'dependencies'  => array('jquery', 'dezo-cookie-script'),
            'version'       => $dezo_const->version,
            'inFooter'      => true
        ],
        [
            'name'          => 'dezo-cookie-set',
            'url'           => $dezo_const->uri.'assets/public/js/dezo-cookie.js',
            'dependencies'  => array('jquery', 'dezo-cookie-script'),
            'version'       => $dezo_const->version,
            'inFooter'      => true
        ],
        [
            'name'          => 'dezo-lightbox-script',
            'url'           => 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js',
            'dependencies'  => array('jquery'),
            'version'       => '2.1.5',
            'inFooter'      => true
        ],
        [
            'name'          => 'dezo-lightbox-set',
            'url'           => $dezo_const->uri.'assets/public/js/dezo-lightbox.js',
            'dependencies'  => array('jquery', 'dezo-lightbox-script'),
            'version'       => $dezo_const->version,
            'inFooter'      => true
        ],
    ];

    foreach ($js_includes as $js_include) {
        wp_register_script( $js_include['name'], $js_include['url'], $js_include['dependencies'], $js_include['version'], $js_include['inFooter'] );
        wp_enqueue_script( $js_include['name'] );
    }

    // cookie acceptance display
    wp_localize_script( 'dezo-cookie', 'dezo_cookie_pop_text', array(
            'message' => __( 'This website uses cookies to ensure you get the best experience on our website.', 'dezo-tools' ),
            'button'  => __( 'OK', 'dezo-tools' ),
            'more'    => __( 'More info', 'dezo-tools' )
        )
    );

    $cookieDisplay = $dezo_const->shortname.'_cookie_display';
    if (!get_option( $cookieDisplay )) {
        wp_dequeue_script( 'dezo-cookie-script' );
        wp_dequeue_script( 'dezo-cookie-set' );
    }
    //_cookie acceptance display

    // Lightbox
    $lightboxDisplay = $dezo_const->shortname.'_lightbox_display';
    if (!get_option( $lightboxDisplay )){
        wp_dequeue_script( 'dezo-lightbox-script' );
        wp_dequeue_script( 'dezo-lightbox-set' );
    }
    //_Lightbox


    /* -- CSS -- */
    $css_includes = [
        [
            'name'          => 'dezo-style-public',
            'url'           => $dezo_const->uri.'assets/public/css/dezo-tools-public.css',
            'dependencies'  => null,
            'version'       => $dezo_const->version,
            'media'         => 'all'
        ],
        [
            'name'          => 'dezo-lightbox-style',
            'url'           => 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css',
            'dependencies'  => null,
            'version'       => '2.1.5',
            'media'         => 'all'
        ],
        [
            'name'          => 'dezo-grids-style',
            'url'           => 'http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css',
            'dependencies'  => null,
            'version'       => '0.6.0',
            'media'         => 'all'
        ],
    ];

    foreach ($css_includes as $css_include) {
        wp_register_style( $css_include['name'], $css_include['url'], $css_include['dependencies'], $css_include['version'], $css_include['media'] );
    	wp_enqueue_style( $css_include['name'] );
    }
}
add_action( 'wp_enqueue_scripts', 'dezo_script_public' );


function dezo_script_admin() {
    $dezo_const = dezo_get_const();

    /* -- JS -- */
    $js_includes = [
        [
            'name'          => 'dezo-script-admin',
            'url'           => $dezo_const->uri.'assets/admin/js/dezo-tools-admin.js',
            'dependencies'  => array('jquery'),
            'version'       => $dezo_const->version,
            'inFooter'      => true
        ],
    ];

    foreach ($js_includes as $js_include) {
        wp_register_script( $js_include['name'], $js_include['url'], $js_include['dependencies'], $js_include['version'], $js_include['inFooter'] );
        wp_enqueue_script( $js_include['name'] );
    }

    /* -- CSS -- */
    $css_includes = [
        [
            'name'          => 'dezo-style-admin',
            'url'           => $dezo_const->uri.'assets/admin/css/dezo-tools-admin.css',
            'dependencies'  => null,
            'version'       => $dezo_const->version,
            'media'         => 'all'
        ],
    ];

    foreach ($css_includes as $css_include) {
        wp_register_style( $css_include['name'], $css_include['url'], $css_include['dependencies'], $css_include['version'], $css_include['media'] );
    	wp_enqueue_style( $css_include['name'] );
    }



}
add_action( 'admin_enqueue_scripts', 'dezo_script_admin' );
