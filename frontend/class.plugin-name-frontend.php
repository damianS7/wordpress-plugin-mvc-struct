<?php

require_once(PLUGIN_DIR . 'frontend/controllers/class.account-controller.php');
require_once(PLUGIN_DIR . 'frontend/models/class.account-model.php');

// Front-end
class PluginName_Frontend {
    public function view_controller() {
        $view_name = get_query_var('plugin_view');
        switch ($view_name) {
            case 'accounts':
                return PluginName_Frontend_AccountController::view_accounts();
            default: // Vista por defecto si no se escoge una valida
                return PluginName_Frontend_AccountController::view_accounts();
        }
    }
 
    // Muestra una vista
    public static function view($view, $data) {
        include_once(PLUGIN_DIR . 'backend/includes/template.php');
    }

    public static function get_query_var($var, $default = 1) {
        global $wp_query;
        return $wp_query->get($var, $default);
    }

    public function custom_rewrite() {
        $plugin_page_id = 222;
        add_rewrite_rule(
            '^plugin-name/([^/]*)/?',
            'index.php?page_id=' . $plugin_page_id . '&plugin_view=$matches[0]',
            'top'
        );
        flush_rewrite_rules();
    }

    public function add_custom_query_var($vars) {
        $vars[] = 'plugin_view';
        return $vars;
    }

    public function init() {
        add_action('init', array( $this, 'custom_rewrite' ));
        add_filter('query_vars', array( $this, 'add_custom_query_var'));
        add_shortcode('myshortcode', array($this, 'view_controller'));

        wp_register_style('prefix_bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
        wp_enqueue_style('prefix_bootstrap');
    }
}
