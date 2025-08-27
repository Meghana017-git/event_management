<?php
/**
 * Plugin Name: Events Custom Plugin
 * Description: A custom plugin to manage events with CRUD functionality, admin settings, and frontend display.
 * Version:     1.0
 * Update URI: false
 * Author:      Your Name
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Define constants
define( 'EM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'EM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Includes
require_once EM_PLUGIN_DIR . 'includes/class-events-cpt.php';
require_once EM_PLUGIN_DIR . 'includes/class-events-settings.php';
require_once EM_PLUGIN_DIR . 'includes/class-events-shortcode.php';
require_once EM_PLUGIN_DIR . 'includes/class-events-template.php';
require_once EM_PLUGIN_DIR . 'includes/class-events-default-location.php';
// Initialize plugin
function em_plugin_init() {
    // Initialize each module
    new EM_Events_CPT();
    new EM_Events_Settings();
    new EM_Events_Shortcode();
    new EM_Events_Template();
    new EM_Events_Defaults();
}
add_action( 'plugins_loaded', 'em_plugin_init' );

// Activation Hook
function em_plugin_activate() {
    // Register CPT so flush_rewrite_rules() works correctly
    $cpt = new EM_Events_CPT();
    $cpt->register_event_cpt();

    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'em_plugin_activate' );

// Deactivation Hook
function em_plugin_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'em_plugin_deactivate' );