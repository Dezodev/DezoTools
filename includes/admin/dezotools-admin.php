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
        $menu_icon = 'data:image/svg+xml;base64,' . base64_encode(file_get_contents(DEZOTOOLS_DIR."assets/admin/img/dezotools-icon-no-bck.svg"));
        add_menu_page(
            'Dezo Tools : Général', 'Dezo Tools', 'manage_options',
            'dezotools_main', [&$this, 'admin_main_page'],
            $menu_icon, 95
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

    /**
     * Setting default options for plugins
     *
     * @return void
     */
    public static function set_default_options() {
        $settings = DezoTools_Admin::get_options_lists();

        foreach ($settings as $sett) {
            if(!get_option($sett['name'])){
                add_option($sett['name'], $sett['args']['default']);
            }
        }
    }

    /**
     * Register options for plugins
     *
     * @return void
     */
    public function register_options() {
        $settings = DezoTools_Admin::get_options_lists();

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
            'dezo-ganalytics-id', 'Code de suivi Google Analytics',
            [&$this, 'dezotools_ganalytics_id'], 'dezotools_main', 'dezotools-insert-code'
        );

        add_settings_field(
            'dezo-custom-header', 'Code additionnel en en-tête de page',
            [&$this, 'dezotools_custom_header'], 'dezotools_main', 'dezotools-insert-code'
        );

        add_settings_field(
            'dezo-custom-footer', 'Code additionnel en pied de page',
            [&$this, 'dezotools_custom_footer'], 'dezotools_main', 'dezotools-insert-code'
        );

        add_settings_section(
            'dezotools-secure-performance', 'Sécurité & Performance',
            [&$this, 'dezotools_secure_performance_options'], 'dezotools_main'
        );

        add_settings_field(
            'dezo-hide-wp-header-details', 'Retirer les détails de wordpress en en-tête de page',
            [&$this, 'dezo_hide_wp_header_details'], 'dezotools_main', 'dezotools-secure-performance'
        );

        add_settings_field(
            'dezo-disable-emojis', 'Désactiver les emojis',
            [&$this, 'dezo_disable_emojis'], 'dezotools_main', 'dezotools-secure-performance'
        );

        add_settings_field(
            'dezo-enable-html-minify', 'HTML minification',
            [&$this, 'dezo_enable_html_minify'], 'dezotools_main', 'dezotools-secure-performance'
        );
    }

    /*-- Plugin Sections --*/

    /**
     * Code for 'insert code' section
     *
     * @return void
     */
    public function dezotools_insert_code_options() {
        echo '<p>Ajouter du code à insérer en en-tête ou en pied de page.</p>';
    }

    /**
     * Code for 'secure & performance' section
     *
     * @return void
     */
    public function dezotools_secure_performance_options() {
        echo '<p>Options pour sécuriser et optimiser votre site.</p>';
    }

    /*-- Plugin Options --*/

    public function dezotools_ganalytics_id() {
        $val = get_option('dezo-ganalytics-id');
        echo $this->form_text_input('text', 'dezo-ganalytics-id', $val);
    }

    public function dezotools_custom_header() {
        $val = get_option('dezo-custom-header');
        echo $this->form_textarea_input('dezo-custom-header', $val, 4);
    }

    public function dezotools_custom_footer() {
        $val = get_option('dezo-custom-footer');
        echo $this->form_textarea_input('dezo-custom-footer', $val, 4);
    }

    public function dezo_hide_wp_header_details() {
        $val = get_option('dezo-hide-wp-header-details');
        echo $this->form_checkbox_input(
            'dezo-hide-wp-header-details', $val,
            'Supprimer les détails de WordPress dans l\'en-tête du site. Cela pour éviter de retrouver facilement la version de votre WP.'
        );
    }

    public function dezo_disable_emojis() {
        $val = get_option('dezo-disable-emojis');
        echo $this->form_checkbox_input('dezo-disable-emojis', $val, 'Retirer les emojis du site');
    }

    public function dezo_enable_html_minify() {
        $val = get_option('dezo-enable-html-minify');
        echo $this->form_checkbox_input('dezo-enable-html-minify', $val, 'Activer la minification du HTML');
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

    public static function get_options_lists() {
        return [
            'dezo-ganalytics-id' => [
                // Code de suivi Google Analytics
                'group' => 'dezotools-settgroup',
                'name' => 'dezo-ganalytics-id',
                'args' => [
                    'type' => 'string',
                    'description' => 'Ex: UA-XXXX-1',
                    'default' => null
                ]
            ],
            'dezo-custom-header' => [
                // Code de suivi Google Analytics
                'group' => 'dezotools-settgroup',
                'name' => 'dezo-custom-header',
                'args' => [
                    'type' => 'string',
                    'description' => null,
                    'default' => null
                ]
            ],
            'dezo-custom-footer' => [
                // Code de suivi Google Analytics
                'group' => 'dezotools-settgroup',
                'name' => 'dezo-custom-footer',
                'args' => [
                    'type' => 'string',
                    'description' => null,
                    'default' => null
                ]
            ],
            'dezo-hide-wp-header-details' => [
                // Code de suivi Google Analytics
                'group' => 'dezotools-settgroup',
                'name' => 'dezo-hide-wp-header-details',
                'args' => [
                    'type' => 'boolean',
                    'description' => null,
                    'default' => 0
                ]
            ],
            'dezo-disable-emojis' => [
                // Code de suivi Google Analytics
                'group' => 'dezotools-settgroup',
                'name' => 'dezo-disable-emojis',
                'args' => [
                    'type' => 'boolean',
                    'description' => null,
                    'default' => 0
                ]
            ],
            'dezo-enable-html-minify' => [
                // Code de suivi Google Analytics
                'group' => 'dezotools-settgroup',
                'name' => 'dezo-enable-html-minify',
                'args' => [
                    'type' => 'boolean',
                    'description' => null,
                    'default' => 0
                ]
            ],
        ];
    }

    /**
     * Helper method for register actions
     *
     * @return void
     */
    private function add_action($action, $fn, $priority = 10, $accepted_args = 1) {
        add_action($action, array(&$this, $fn), $priority, $accepted_args);
    }

    private function form_text_input(String $type, String $name, $value) {
        $settings = DezoTools_Admin::get_options_lists();

        $html = '<input type="'. $type .'" name="'. $name .'" id="'. $name .'" value="'. esc_attr($value) .'">';

        if (!empty($settings[$name]['args']['description'])) {
            $html .= '<p class="description">'.$settings[$name]['args']['description'].'</p>';
        }

        return $html;
    }

    private function form_textarea_input(String $name, $value, $rows = 3) {
        $settings = DezoTools_Admin::get_options_lists();

        $html = '<textarea name="'. $name .'" id="'. $name .'" rows="'. $rows .'">'. esc_attr($value) .'</textarea>';

        if (!empty($settings[$name]['args']['description'])) {
            $html .= '<p class="description">'.$settings[$name]['args']['description'].'</p>';
        }

        return $html;
    }

    private function form_checkbox_input(String $name, $value, String $label = null) {
        $settings = DezoTools_Admin::get_options_lists();

        $html = '
            <label for="'. $name .'"><input type="checkbox" name="'. $name .'" id="'. $name .'" value="1"'
            . checked(1, $value, false) .'>
        ';

        if (!empty($label)) {
            $html .= $label.'</label>';
        } else {
            $html .= 'Activer cette fonctionnalité</label>';
        }

        if (!empty($settings[$name]['args']['description'])) {
            $html .= '<p class="description">'.$settings[$name]['args']['description'].'</p>';
        }

        return $html;
    }
}

?>
