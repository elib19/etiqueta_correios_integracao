<?php
/**
 * Plugin Name: Virtuaria Correios WCFM Integration
 * Description: Integração de geração de etiquetas dos Correios para o WCFM no WooCommerce.
 * Version: 1.0.0
 * Author: Seu Nome
 * Text Domain: virtuaria-correios
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Inclui os hooks do WCFM
require_once plugin_dir_path(__FILE__) . 'hooks/wcfm-hooks.php';

// Função de ativação do plugin
function virtuaria_correios_activate() {
    add_option('virtuaria_correios_api_key', '');
    add_option('virtuaria_correios_usuario', '');
    add_option('virtuaria_correios_cartao', '');
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'virtuaria_correios_activate');

// Função de desativação do plugin
function virtuaria_correios_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'virtuaria_correios_deactivate');

// Função de desinstalação do plugin
function virtuaria_correios_uninstall() {
    delete_option('virtuaria_correios_api_key');
    delete_option('virtuaria_correios_usuario');
    delete_option('virtuaria_correios_cartao');
}
register_uninstall_hook(__FILE__, 'virtuaria_correios_uninstall');

