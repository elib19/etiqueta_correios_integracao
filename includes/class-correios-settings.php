<?php

if (!defined('ABSPATH')) {
    exit;
}

class Correios_Settings {

    public static function init() {
        add_action('admin_menu', array(__CLASS__, 'add_admin_menu'));
        add_action('admin_init', array(__CLASS__, 'register_settings'));
    }

    public static function add_admin_menu() {
        add_menu_page(
            __('Configurações Correios', 'correios-wcfm-integration'),
            __('Correios', 'correios-wcfm-integration'),
            'manage_options',
            'correios-settings',
            array(__CLASS__, 'settings_page'),
            'dashicons-admin-generic'
        );
    }

    public static function register_settings() {
        register_setting('correios_settings_group', 'correios_wcfm_usuario');
        register_setting('correios_settings_group', 'correios_wcfm_cartao');
        register_setting('correios_settings_group', 'correios_wcfm_api_key');
    }

    public static function settings_page() {
        include CORREIOS_WCFM_PLUGIN_PATH . 'views/correios-admin-settings.php';
    }
}
?>
