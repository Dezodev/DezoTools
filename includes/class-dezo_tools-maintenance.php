<?php

class dezo_tools_maintenance
{
    private $dezo_const=null;
    
    /**
     * Class constructor
     * @private
     * @author DezoDev
     */
    function __construct()
    {
        // Load constants
        require_once dirname( __FILE__ ).'/dezo-tools-const.php';
        $this->dezo_const  = dezo_get_const();
        
        add_action('template_redirect', array( &$this, 'dezo_template_redirect'));
    }
    
    /**
     * Check if is not wordpress admin
     * @author DezoDev
     * @return boolean
     */
    function is_valid_page() {
        return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
    }
    
    /**
     * Redirect the site to template if is not admin user
     * @author DezoDev
     */
    function dezo_template_redirect(){
        if(!is_super_admin()){
            if( !is_admin() && !$this->is_valid_page()){
                $this->load_maintenance_page();
            }
        }
    }
    
    /**
     * Load maintenance page
     * @author DezoDev
     */
    function load_maintenance_page(){
        header('HTTP/1.0 503 Service Unavailable');
        include_once($this->dezo_const->dir.'template/maintenance.php');
        exit();
    }
}