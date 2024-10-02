<?php
/**
 * Plugin Name: Correios Etiqueta e Declaração para WCFM
 * Plugin URI: https://brasilnarede.online/
 * Description: Gera etiqueta para envio pelos correios e declaração de conteúdo para cada vendedor no WCFM Marketplace.
 * Version: 1.0
 * Author: Eli Silva
 * Author URI: http://brasilnarede.online
 * Tested up to: 6.3
 * Stable tag: 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Incluir arquivos
include_once 'includes/install.php';
include_once 'includes/uninstall.php';
include_once 'includes/helper.php';
include_once 'includes/vendor-dashboard.php';
include_once 'includes/settings.php';

// Função de ativação
function correios_activate() {
    correios_install();
}
register_activation_hook( __FILE__, 'correios_activate' );

// Adiciona o formulário no dashboard do vendedor
add_action( 'wcfmmp_store_manage', 'correios_vendor_dashboard' );

// Adiciona as configurações ao menu de administração
add_action( 'admin_menu', 'correios_add_admin_menu' );

// Adiciona o menu de configurações
function correios_add_admin_menu() {
    add_menu_page( 'Configurações Correios', 'Correios', 'manage_options', 'correios_settings', 'correios_settings_page' );
}
