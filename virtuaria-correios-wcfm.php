<?php
/**
 * Plugin Name: Virtuaria Correios WCFM Integration
 * Plugin URI: https://brasilnarede.online
 * Description: Integração de geração de etiquetas dos Correios para o WCFM no WooCommerce.
 * Version: 1.0.0
 * Author: Eli Silva
 * Text Domain: virtuaria-correios
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Inclui os arquivos necessários
require_once plugin_dir_path(__FILE__) . 'hooks/wcfm-hooks.php';
require_once plugin_dir_path(__FILE__) . 'includes/virtuaria-wrappers.php';

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

// Adicionar o menu ao WCFM
add_filter('wcfm_menus', 'virtuaria_correios_wcfm_menu', 50);
function virtuaria_correios_wcfm_menu($menus) {
    if (wcfm_is_vendor()) {
        $menus['virtuaria-etiquetas'] = array(
            'label'    => __('Gerar Etiqueta Correios', 'virtuaria-correios'),
            'url'      => wcfm_get_endpoint_url('virtuaria-etiquetas'),
            'icon'     => 'envelope',
            'priority' => 75
        );
    }
    return $menus;
}

// Endpoint para a página de geração de etiquetas
add_action('init', 'virtuaria_add_wcfm_endpoints');
function virtuaria_add_wcfm_endpoints() {
    add_rewrite_endpoint('virtuaria-etiquetas', EP_PAGES);
}

// Renderiza a página de geração de etiquetas no painel do vendedor
add_action('wcfm_load_views', 'virtuaria_wcfm_etiquetas_page');
function virtuaria_wcfm_etiquetas_page($view) {
    global $WCFM, $wp_query;

    if (isset($wp_query->query_vars['virtuaria-etiquetas'])) {
        if (file_exists(plugin_dir_path(__FILE__) . '../views/virtuaria-wcfm-view.php')) {
            $WCFM->template->get_template('virtuaria-wcfm-view.php', array());
        } else {
            echo '<div class="notice notice-error"><p>' . __('Erro: Arquivo de template não encontrado.', 'virtuaria-correios') . '</p></div>';
        }
    }
}
?>
