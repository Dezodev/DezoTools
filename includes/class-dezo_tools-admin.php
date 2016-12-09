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
        $admin_page = [
            'page_title' => 'DezoTools > Réglages',
            'menu_title' => 'Dezo-Tools',
            'capability' => 'manage_options',
            'menu_slug' => 'dezotools-admin-page',
        	'function' => array($this, 'dezo_admin_page'),
        	'icon' => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwMCAyMDAiIGhlaWdodD0iMjAwcHgiIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAyMDAgMjAwIiB3aWR0aD0iMjAwcHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxnPjxnPjxwYXRoIGQ9Ik0xOTYuNzg5LDM2LjI0N2wtMjcuMzQ1LDI3LjM0NWMtMi41MjksMi41MzItNi4wMjIsNC4wOTUtOS44NzksNC4wOTVjLTMuODYxLDAtNy4zNjItMS41NjMtOS44OTItNC4wOTUgICAgbC02LjU5MS02LjU4OGMtMi41My0yLjUzMi00LjA4OS02LjAyNy00LjA4OS05Ljg4OHMxLjU1OS03LjM1NCw0LjA4OS05Ljg4NGwyNy4zNDUtMjcuMzQ1ICAgIGMtMTYuNzE4LTYuNTUtMzYuNDYxLTMuMDc5LTQ5Ljk3LDEwLjQzMWMtMTguMiwxOC4xOTctMTguMiw0Ny43MDQsMCw2NS45YzE4LjIwMSwxOC4yMDEsNDcuNzA0LDE4LjIwMSw2NS45LDAgICAgQzE5OS44NzEsNzIuNzEsMjAzLjM0LDUyLjk2OSwxOTYuNzg5LDM2LjI0N3oiIGZpbGw9IiM1RTg4OUUiLz48cGF0aCBkPSJNNTAuMDgyLDEyMC41NjZsLTI4LjM3NiwyNi4zMWMtNS4wMTYsNC42NTQtOC4yMDUsMTEuMjYzLTguMzQ1LDE4LjY0NSAgICBjLTAuMTQsNy4zODIsMi43OTcsMTQuMTA0LDcuNjM3LDE4Ljk0M2wxLjIxOSwxLjIxOGM0LjgzNiw0LjgzOCwxMS41NTgsNy43NzcsMTguOTQsNy42MzdjNy4zODYtMC4xMzgsMTMuOTg4LTMuMzI3LDE4LjY0NC04LjM0NyAgICBsMjYuMzEtMjguMzc2TDUwLjA4MiwxMjAuNTY2eiBNNDguODQzLDE3NC4zMDljLTQuNTQ0LDQuNTUzLTExLjkyMiw0LjU1My0xNi40NzQsMGMtNC41NDgtNC41NDgtNC41NDgtMTEuOTI2LDAtMTYuNDc0ICAgIGM0LjU1Mi00LjU1MywxMS45My00LjU1MywxNi40NzQsMEM1My4zOTEsMTYyLjM4Myw1My4zOTEsMTY5Ljc2MSw0OC44NDMsMTc0LjMwOXoiIGZpbGw9IiM1RTg4OUUiLz48L2c+PGc+PHBhdGggZD0iTTk0LjQ1Niw3NS43NDRjLTEuODAyLDAtMy40MzMsMC43MjctNC42MTIsMS45MDhMNTkuNTMsMTA3Ljk2OWMtMS4xODMsMS4xOC0xLjkxLDIuODEyLTEuOTEsNC42MTIgICAgYzAsMS44MDMsMC43MjcsMy40MzQsMS45MSw0LjYxMmw2Ny44NzUsNjcuODhjMTAuOTI3LDEwLjkyMSwyOC42MjQsMTAuOTE3LDM5LjU0MiwwYzEwLjkyMy0xMC45MiwxMC45MjMtMjguNjIxLDAtMzkuNTQyICAgIEw5OS4wNjgsNzcuNjUyQzk3Ljg4OSw3Ni40NzEsOTYuMjU5LDc1Ljc0NCw5NC40NTYsNzUuNzQ0eiBNMTQwLjkxNywxNjcuNjA4YzEuODExLDEuODEzLDEuODExLDQuNzc4LDAsNi41ODkgICAgYy0xLjgxMSwxLjgxNC00Ljc4LDEuODE0LTYuNTkxLDBsLTU5LjMxLTU5LjMxYy0xLjgxNC0xLjgxMS0xLjgxNC00Ljc3NiwwLTYuNTkxYzEuODExLTEuODExLDQuNzc2LTEuODExLDYuNTksMEwxNDAuOTE3LDE2Ny42MDggICAgeiBNMTU2LjA3NiwxNTIuNDUxYzEuODExLDEuODEzLDEuODExLDQuNzc4LDAsNi41OTFzLTQuNzgsMS44MTMtNi41OTEsMGwtNTkuMzEtNTkuMzEzYy0xLjgxOC0xLjgxMy0xLjgxOC00Ljc3OCwwLTYuNTkgICAgYzEuODA3LTEuODEzLDQuNzc2LTEuODEzLDYuNTg2LDAuMDAyTDE1Ni4wNzYsMTUyLjQ1MXoiIGZpbGw9IiM1RTg4OUUiLz48cGF0aCBkPSJNMTguOTQ4LDU0LjYyN2w3LjQxNC0wLjI1OGwzOC43NzEsMzguNzY5bDkuODgzLTkuODg2TDM2LjI1LDQ0LjQ4NmwwLjI1Ni03LjQxNiAgICBjMC4wMi0wLjYyOS0wLjExNi0xLjI3NS0wLjQzMi0xLjg3M2MtMC4zMTUtMC41OTktMC43NzktMS4wNzMtMS4zMTUtMS40MTFMOS44ODgsMTguMTI4TDAsMjguMDFsMTUuNjY3LDI0Ljg3NyAgICBjMC4zMzIsMC41MzYsMC44MTIsMC45OTEsMS40MDcsMS4zMDlDMTcuNjczLDU0LjUxMiwxOC4zMTcsNTQuNjQ5LDE4Ljk0OCw1NC42Mjd6IiBmaWxsPSIjNUU4ODlFIi8+PC9nPjwvZz48L3N2Zz4=',
            'order' => 99
        ];

        // Add admin pages
        add_menu_page(
        	$admin_page['page_title'],
        	$admin_page['menu_title'],
        	$admin_page['capability'],
        	$admin_page['menu_slug'],
        	$admin_page['function'],
        	$admin_page['icon'],
            $admin_page['order']
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
        $htmlMinify = $this->dezo_const->shortname.'_html_minify';
        $maintenanceEndDate = $this->dezo_const->shortname.'_maintenance_end_date';

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

            // Reason of maintenance
        if($this->save_options($maintenanceEndDate)) $update++;

            // HTML minify
        if($this->save_options($htmlMinify, true)) $update++;

		if (isset($_POST['token']) && $update>0):
            $fl_save = true;
            $this->dezo_after_save();
        else:
            $fl_save = false;
        endif;

		include $this->dezo_const->dir_includes . 'partials/dezo-admin-display.php';
	}

    /**
	 * Function to execute action after option save
	 *
	 * @since    0.0.1
	 */
	public function dezo_after_save(){

			//Field Name
		$postRevision = $this->dezo_const->shortname.'_num_post_revision';
		$postInterval = $this->dezo_const->shortname.'_post_revision';

		if (get_option($postRevision) != 0) {
            if (WP_POST_REVISIONS != get_option($postRevision)) {
                define( 'WP_POST_REVISIONS', get_option($postRevision) );
            }
		}else {
			define( 'WP_POST_REVISIONS', -1);
		}

        if (get_option($postInterval) != 0) {
            if (AUTOSAVE_INTERVAL != get_option($postInterval)) {
                define( 'AUTOSAVE_INTERVAL', get_option($postInterval) );
            }
		}else {
			define( 'AUTOSAVE_INTERVAL', -1);
		}

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
            $dezo_const->shortname.'_maint_activation' => false,
            $dezo_const->shortname.'_html_minify'=> false,
            $dezo_const->shortname.'_maintenance_end_date'=> ''
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
