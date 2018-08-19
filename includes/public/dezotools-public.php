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
        // Add menu and admin page
        $this->add_action('wp_head', 'insert_ga_tracking_code');
    }

    /*-- Plugin actions --*/

    public function insert_ga_tracking_code() {
        $gaID = get_option('ganalytics-id');

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
