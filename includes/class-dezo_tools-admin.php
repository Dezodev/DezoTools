<?php

/**
 * Admin plugin class
 */
class dezo_tools_admin
{
    public $dezo_const=null;

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
		add_action('admin_init', array(&$this, 'register_dezo_tools_setting'));
        add_action('admin_menu', array(&$this, 'dezo_admin_menu'));
    }

    /**
     * Add settings page on menu
     *
     * @return void
     * @since 0.1.0
     */
    public function dezo_admin_menu(){
        // Add admin pages
		add_menu_page(
            'DezoTools > Réglages',
            'DezoTools',
            'manage_options',
            'dezotools-admin-page',
            array($this, 'dezo_admin_page'),
            'dashicons-admin-tools', 99
        );
    }

    /**
     * Content admin page and save data
     *
     * @return void
     * @since  0.1.0
     */
	public function dezo_admin_page(){

		$update = 0;
        
		// Saving Data
			// Fields name
		$logoInLogin = $this->dezo_const->shortname.'_logo_in_login';
		$cookieDisplay = $this->dezo_const->shortname.'_cookie_display';
		$lightboxDisplay = $this->dezo_const->shortname.'_lightbox_display';
		$headerCode = $this->dezo_const->shortname.'_header_code';
		$footerCode = $this->dezo_const->shortname.'_footer_code';
		$postRevision = $this->dezo_const->shortname.'_num_post_revision';
		$postInterval = $this->dezo_const->shortname.'_post_revision';
        $maintReason = $this->dezo_const->shortname.'_maint_reason';
        $maintActivation = $this->dezo_const->shortname.'_maint_activation';

			// Display cookie information
        if($this->save_options($cookieDisplay, true)) $update++;

			// Display lightbox
        if($this->save_options($lightboxDisplay, true)) $update++;

			// Site logo in login page
        if($this->save_options($logoInLogin, true)) $update++;

			// Custom code to header
		if($this->save_options($headerCode)) $update++;

			// Custom code to footer
		if($this->save_options($footerCode)) $update++;

			// Limitation of the number of revision
        if($this->save_options($postRevision)) $update++;

			// Post auto-save interval
		if($this->save_options($postInterval)) $update++;

            // Activation of maintenance
        if($this->save_options($maintActivation)) $update++;

        	// Reason of maintenance
		if($this->save_options($maintReason)) $update++;

		if (isset($_POST['token'])) $this->dezo_after_save();

		include $this->dezo_const->dir_includes . 'partials/dezo-admin-display.php';
	}

    /**
     * Save options
     *
     * @param  string  $name name of option
     * @param  boolean $bool if the option is boolean
     * @return boolean        if the option is update
     * @since  0.1.0
     */
    private function save_options($name, $bool=false){

        if (!$bool && $name != null) {
            if (isset($_POST[$name]) && isset($_POST['token']) ) {
    			update_option($name, $_POST[$name]);
                return true;
    		} elseif (!isset($_POST[$name]) && isset($_POST['token'])) {
    			update_option($name, '');
                return false;
            }
        } elseif($bool && $name != null) {
            if (isset($_POST[$name]) && isset($_POST['token']) ) {
    			update_option($name, 1);
    		} elseif (!isset($_POST[$name]) && isset($_POST['token']) && 1 == get_option($name)) {
    			update_option($name, 0);
    		}
        }

        // If one of params is null
        return false;
    }


    /**
     * Get default Options
     *
     * @return array    All default Options
     * @since  0.1.0
     */
    public static function get_default_options() {
        require_once dirname( __FILE__ ).'/dezo-tools-const.php';
        $dezo_const  = dezo_get_const();

        $options = array(
            $dezo_const->shortname.'_logo_in_login' => false,
            $dezo_const->shortname.'_cookie_display' => false,
            $dezo_const->shortname.'_lightbox_display' => false,
            $dezo_const->shortname.'_header_code' => '',
            $dezo_const->shortname.'_footer_code' => '',
            $dezo_const->shortname.'_maint_reason' => '',
            $dezo_const->shortname.'_maint_activation' => false

        );

        return $options;
    }

    /**
     * Return option and their actual value
     *
     * @return stdClass    All options
     * @since  0.0.1
     */
	public static function get_all_options() {
		$DefaultOptions = dezo_tools_admin::get_default_options(); // Get Default options list

		// Get options list
		$options = new stdClass();
    	foreach( $DefaultOptions as $option_name => $default_value ) {
			$options->$option_name = get_option($option_name) ? get_option($option_name) : 0 ; // By Default 0 for uncheck checkbox
		}
		return $options;
	}


    /**
     * Setup Default value on first activation
     *
     * @return void
     * @since  0.0.1
     */
    public static function setup_default_options() {
    	$DefaultOptions = dezo_tools_admin::get_default_options(); // Get Default options list

		// Setup Default value on the first time
    	foreach( $DefaultOptions as $option_name => $default_value ) {
    		// delete_option($option_name); // Only use this for test
			if(!get_option($option_name)) add_option($option_name, $default_value);

		}

    }

    /**
     * Register setting for setting page
     *
     * @return void
     * @since  0.0.1
     */
    function register_dezo_tools_setting() {

    	$options = $this->get_default_options();

    	foreach( $options as $option_name => $default_value ) {
			register_setting('dezo-tools', $option_name);
		}

	}

}
