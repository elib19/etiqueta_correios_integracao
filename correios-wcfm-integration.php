<?php
/*
Plugin Name: Correios Etiquetas - Integração WCFM
Description: Plugin para integração de etiquetas dos Correios com o WCFM Marketplace. Apenas o administrador configura as credenciais, e os vendedores geram etiquetas.
Version: 1.0
Author: Eli Silva
Text Domain: correios-wcfm
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Bloquear acesso direto
}

// Definir constantes do plugin
define( 'CORREIOS_WCFM_PATH', plugin_dir_path( __FILE__ ) );
define( 'CORREIOS_WCFM_URL', plugin_dir_url( __FILE__ ) );

// Carregar classes principais
include_once CORREIOS_WCFM_PATH . 'includes/class-correios-install.php';
include_once CORREIOS_WCFM_PATH . 'includes/class-correios-uninstall.php';
include_once CORREIOS_WCFM_PATH . 'includes/class-correios-settings.php';
include_once CORREIOS_WCFM_PATH . 'includes/class-correios-helper.php';

// Registro de ativação e desativação
register_activation_hook( __FILE__, array( 'Correios_Install', 'install' ) );
register_deactivation_hook( __FILE__, array( 'Correios_Uninstall', 'uninstall' ) );

// Inicializar o plugin
function correios_wcfm_init() {
    if ( is_admin() ) {
        Correios_Settings::init();
    }
    Correios_Helper::init();
}
add_action( 'plugins_loaded', 'correios_wcfm_init' );
