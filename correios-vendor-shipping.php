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

// Include files
include_once 'includes/install.php';
include_once 'includes/uninstall.php';
include_once 'includes/helper.php';
include_once 'includes/vendor-dashboard.php';
include_once 'includes/settings.php';

// Função de ativação
function correios_activate() {
    correios_install();
    correios_populate_initial_data();
}
register_activation_hook( __FILE__, 'correios_activate' );

// Função de desinstalação
register_uninstall_hook( __FILE__, 'correios_uninstall' );

// Carregar o formulário no dashboard do vendedor
add_action( 'wcfmmp_store_manage', 'correios_vendor_dashboard' );

// Adiciona a opção de envio na configuração do WCFM
add_filter( 'wcfmmp_shipping_options', 'correios_add_shipping_option' );

function correios_add_shipping_option( $shipping_options ) {
    $shipping_options['correios'] = __( 'Correios', 'correios-vendor-shipping' );
    return $shipping_options;
}

// Adiciona menu de configurações
add_action( 'admin_menu', 'correios_add_admin_menu' );
