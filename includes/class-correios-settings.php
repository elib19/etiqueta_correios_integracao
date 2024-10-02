<?php

class Correios_Settings {

    public static function init() {
        add_action( 'admin_menu', array( __CLASS__, 'add_menu' ) );
        add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
    }

    public static function add_menu() {
        add_menu_page(
            'Configurações Correios',
            'Correios Etiquetas',
            'manage_options',
            'correios-wcfm-settings',
            array( __CLASS__, 'settings_page' ),
            'dashicons-admin-generic'
        );
    }

    public static function register_settings() {
        register_setting( 'correios_settings_group', 'correios_user' );
        register_setting( 'correios_settings_group', 'correios_cartao' );
        register_setting( 'correios_settings_group', 'correios_api_key' );
    }

    public static function settings_page() {
        include CORREIOS_WCFM_PATH . 'includes/views/correios-settings-view.php';
    }
}
