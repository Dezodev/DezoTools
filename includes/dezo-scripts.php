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
        [
            'name'          => 'dezo-countdown-script',
            'url'           => $dezo_const->uri.'assets/public/js/jquery.countdown.min.js',
            'dependencies'  => array('jquery'),
            'version'       => '2.2.0',
            'inFooter'      => true
        ],
        [
            'name'          => 'dezo-maintenance-set',
            'url'           => $dezo_const->uri.'assets/public/js/dezo-maintenance.js',
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
    wp_localize_script( 'dezo-cookie-set', 'dezo_cookie_pop_text', array(
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

    // Maitenance countdown
    $maintActivation = get_option($dezo_const->shortname.'_maint_activation');
    $maintenanceEndDate = get_option($dezo_const->shortname.'_maintenance_end_date');

    echo "is_super_admin : ".var_export(is_super_admin(), true)."<br>".
        "get_option(maintActivation) : ".var_export($maintActivation, true)."<br>".
        "get_option(maintenanceEndDate) : ".var_export($maintenanceEndDate, true)."<br>";



    if(is_super_admin()){
        wp_dequeue_script( 'dezo-countdown-script' );
        wp_dequeue_script( 'dezo-maintenance-set' );
    } elseif(!$maintActivation) {
        echo "Maint. desactivé";
        wp_dequeue_script( 'dezo-countdown-script' );
        wp_dequeue_script( 'dezo-maintenance-set' );
    } elseif (empty($maintenanceEndDate)) {
        echo "Pas de date";
        wp_dequeue_script( 'dezo-countdown-script' );
        wp_dequeue_script( 'dezo-maintenance-set' );
    } else {
        wp_localize_script( 'dezo-maintenance-set', 'php_vars', array(
                'endDate' => $maintenanceEndDate,
            )
        );
    }
    //_Maitenance countdown

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
            'url'           => 'https://cdnjs.cloudflare.com/ajax/libs/pure/0.6.0/grids-responsive-min.css',
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

    /* -- JS --  */
    $js_includes = [
        [
            'name'          => 'dezo-script-admin',
            'url'           => $dezo_const->uri.'assets/admin/js/dezo-tools-admin.js',
            'dependencies'  => array('jquery', 'dezo-datetimepicker-script-admin'),
            'version'       => $dezo_const->version,
            'inFooter'      => true
        ],
        [
            'name'          => 'dezo-datetimepicker-script-admin',
            'url'           => $dezo_const->uri.'assets/admin/js/jquery.datetimepicker.full.min.js',
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
        [
            'name'          => 'dezo-datetimepicker-style-admin',
            'url'           => $dezo_const->uri.'assets/admin/css/jquery.datetimepicker.min.css',
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
