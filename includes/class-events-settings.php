<?php
class EM_Events_Settings {
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_settings_page' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
    }

    public function add_settings_page() {
        add_menu_page(
            'Events Settings',
            'Events Settings',
            'manage_options',
            'em-settings',
            [ $this, 'settings_page_html' ],
            'dashicons-admin-generic'
        );
    }

    public function register_settings() {
        register_setting( 'em_settings_group', 'em_default_location' );
        add_settings_section( 'em_main', 'Default Settings', null, 'em-settings' );
        add_settings_field( 'em_default_location', 'Default Location', function() {
            $value = get_option('em_default_location', '');
            echo '<input type="text" name="em_default_location" value="'. esc_attr($value) .'" />';
        }, 'em-settings', 'em_main' );
    }

    public function settings_page_html() {
        echo '<div class="wrap"><h1>Events Settings</h1>';
        echo '<form method="post" action="options.php">';
        settings_fields('em_settings_group');
        do_settings_sections('em-settings');
        submit_button();
        echo '</form></div>';
    }
}