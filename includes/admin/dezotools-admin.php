<?php

/**
 * Dezo Tools Admin class
 */
class DezoTools_Admin {

    /**
     * Constructor
     */
    function __construct() {
        // Add menu and admin page
        $this->add_action('admin_menu', 'add_admin_menu');

        // Add styles in admin
        $this->add_action('admin_enqueue_scripts', 'admin_style');
        
        // Register options
        $this->add_action('admin_init', 'register_options');
    }
    
    /*-- Plugin actions --*/
    
    /**
     * Create admin page
     * 
     * @return void
     */
    public function add_admin_menu() {
        add_menu_page(
            'Dezo Tools : Général', 'Dezo Tools', 'manage_options',
            'dezotools_main', [&$this, 'admin_main_page'],
            'dashicons-admin-tools', 95
        );

        add_submenu_page(
            'dezotools_main', 'Dezo Tools : Général', 'Général',
            'manage_options', 'dezotools_main', [&$this, 'admin_main_page']
        );
        
        // Add custom options after page created
        $this->add_action('admin_init', 'add_custom_options');
    }

    /**
     * Add stylesheet to admin dashboard
     * 
     * @return void
     */
    public function admin_style() {
        wp_enqueue_style(
            'admin-styles', 
            DEZOTOOLS_URI.'assets/admin/css/dezo-tools.min.css'
        );
    }

    public function get_options_lists() {
        return [
            'ganalytics-id' => [
                // Code de suivi Google Analytics
                'group' => 'dezotools-settgroup',
                'name' => 'ganalytics-id',
                'args' => [
                    'type' => 'string',
                    'description' => 'Ex: UA-XXXX-1',
                    'default' => null
                ]
            ],
        ];
    }

    /**
     * Register options for plugins
     * 
     * @return void
     */
    public function register_options() {
        $settings = $this->get_options_lists();

        foreach ($settings as $sett) {
            register_setting($sett['group'], $sett['name'], $sett['args']);
        }
    }

    /**
     * Register custom option for plugins
     * 
     * @return void
     */
    public function add_custom_options() {
        add_settings_section( 
            'dezotools-insert-code', 'Insertion de code',
            [&$this, 'dezotools_insert_code_options'], 'dezotools_main'
        );

        add_settings_field(
            'ganalytics-id', 'Code de suivi Google Analytics',
            [&$this, 'dezotools_ganalytics_id'], 'dezotools_main', 'dezotools-insert-code'
        );
    }
    
    /*-- Plugin Sections --*/

    /**
     * Code for 'insert code' section
     * 
     * @return void
     */
    public function dezotools_insert_code_options() {
        echo 'Ajouter du code à insérer en en-tête ou en pied de page.';
    }

    /*-- Plugin Options --*/
    
    public function dezotools_ganalytics_id() {
        $val = get_option('ganalytics-id');
        echo $this->form_text_input('text', 'ganalytics-id', $val);
    }

    /*-- Plugin Methods --*/

    /**
     * Template for main admin page
     * 
     * @return void
     */
    public function admin_main_page() {
        include DEZOTOOLS_INCLUDES.'admin/templates/main.php';
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

    private function form_text_input(String $type, String $name, $value) {
        $settings = $this->get_options_lists();
        
        $html = '<input type="'. $type .'" name="'. $name .'" id="'. $name .'" value="'. esc_attr($value) .'">';
        
        if (!empty($settings[$name]['args']['description'])) {
            $html .= '<p class="description">'.$settings[$name]['args']['description'].'</p>';
        }
        
        return $html;
    }
}