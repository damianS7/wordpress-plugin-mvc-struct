<?php
/**
 * Plugin Name: PluginName
 * Plugin URI:
 * Description:
 * Version: 0.1
 * Author: damianS7
 * Author URI:
 * Text Domain: plugin-name
 */


// Impedimos el acceso si se intenta acceder directamente al plugin
if (!function_exists('add_action')) {
    exit;
}

define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN_DIR', plugin_dir_path(__FILE__));

// BACKEND (WP-ADMIN)
if (is_admin()) {
    require_once(PLUGIN_DIR . 'backend/plugin-name-backend.php');
    require_once(PLUGIN_DIR . 'install.php');
    $install = new PluginName_Install();
    register_activation_hook(__FILE__, array( $install, 'plugin_activation' ));
    register_deactivation_hook(__FILE__, array( $install, 'plugin_deactivation' ));

    $backend = new PluginName_Backend();
    add_action('init', array($backend, 'init'));
}

// FRONTEND
if (!is_admin()) {
    require_once(PLUGIN_DIR . 'frontend/class.plugin-name-frontend.php');
    $frontend = new PluginName_Frontend();
    add_action('init', array( $frontend, 'init' ));
}
