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

// Inclui o arquivo de helper
require_once plugin_dir_path(__FILE__) . 'includes/helper.php';

// Função de instalação do plugin
register_activation_hook(__FILE__, 'correios_install_plugin');
function correios_install_plugin() {
    require_once plugin_dir_path(__FILE__) . 'install.php';
    correios_install();
}

// Função de desinstalação do plugin
register_uninstall_hook(__FILE__, 'correios_uninstall_plugin');
function correios_uninstall_plugin() {
    require_once plugin_dir_path(__FILE__) . 'uninstall.php';
    correios_uninstall();
}

// Inclui as configurações do remetente e integrações
require_once plugin_dir_path(__FILE__) . 'includes/settings.php';

// Adiciona o botão de geração de etiqueta nas ações do WCFM
add_action('woocommerce_admin_order_actions_end', 'add_custom_order_actions_button', 100, 1);
add_filter('wcfm_orders_actions', 'correios_wcfm_order_action_button', 10, 5);
