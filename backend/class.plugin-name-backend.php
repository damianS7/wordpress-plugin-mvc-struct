<?php
require_once(PLUGIN_DIR . 'admin/controllers/class.admin-account-controller.php');
require_once(PLUGIN_DIR . 'admin/models/class.admin-account-model.php');

class PluginName_Backend {
    private $accounts_controller;

    public function __construct() {
        $this->accounts_controller = new PluginName_Backend_AccountController();
    }

    public function plugin_menu() {
        add_menu_page('PluginName', 'Plugin Name', 'manage_options', 'pluginname-accounts', array($this->accounts_controller, 'view_accounts'));
        add_submenu_page('pluginname-accounts', 'PluginName', 'Accounts', 'manage_options', 'pluginame-accounts', array($this->accounts_controller, 'view_accounts'));
    }

    public static function view($view, $data) {
        include_once(PLUGIN_DIR . 'backend/includes/template.php');
    }

    public function init() {
        add_action('admin_menu', array( $this, 'plugin_menu' ));
        wp_register_style('prefix_bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
        wp_enqueue_style('prefix_bootstrap');
    }
}
