<?php
/**
 * Plugin Name: Etiquetas Correios WCFM Integration
 * Description: Plugin para integrar a geração de etiquetas dos Correios com o WCFM.
 * Version: 1.0
 * Author: Eli Silva
 */

// Evita acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

// Inclui os arquivos de instalação
require_once plugin_dir_path(__FILE__) . 'etiquetas-correios-install.php';

// Hook para adicionar o menu ao WCFM
add_filter('wcfm_menus', 'etiquetas_correios_wcfm_menu', 50);
function etiquetas_correios_wcfm_menu($menus) {
    if (wcfm_is_vendor()) {
        $menus['etiquetas-correios'] = array(
            'label'    => __('Gerar Etiquetas Correios', 'etiquetas-correios'),
            'url'      => wcfm_get_endpoint_url('etiquetas-correios'),
            'icon'     => 'envelope',
            'priority' => 75
        );
    }
}

// Adiciona o endpoint para a página de redirecionamento
add_action('init', 'etiquetas_add_wcfm_endpoints');
function etiquetas_add_wcfm_endpoints() {
    add_rewrite_endpoint('etiquetas-correios', EP_PAGES);
}

// Carrega o formulário diretamente no endpoint
add_action('template_redirect', 'etiquetas_wcfm_template_redirect');
function etiquetas_wcfm_template_redirect() {
    global $wp_query;

    if (isset($wp_query->query_vars['etiquetas-correios'])) {
        if (!is_user_logged_in()) {
            // Redireciona para a página de login do WooCommerce
            wp_redirect(wp_login_url());
            exit;
        }

        get_header();
        do_action('wcfm_load_views_before');
        do_action('wcfm_load_styles');

        echo '<div class="wcfm-container">';
        echo '<div class="wcfm-content">';

        // Carrega a view de geração de etiqueta
        include plugin_dir_path(__FILE__) . 'views/gerar-etiqueta.php';

        echo '</div>'; // Fecha wcfm-content
        echo '</div>'; // Fecha wcfm-container

        get_footer();

        // JavaScript para excluir o bookmarklet após 90 segundos
        echo '<script>
        setTimeout(function() {
            var bookmarkletLink = document.getElementById("bookmarklet-link");
            bookmarkletLink.href = "javascript:void(0);"; // Remove a funcionalidade do bookmarklet
            bookmarkletLink.innerHTML = "' . __('Bookmarklet expirou', 'etiquetas-correios') . '"; // Muda o texto
            bookmarkletLink.style.pointerEvents = "none"; // Desabilita o clique
            bookmarkletLink.style.backgroundColor = "#ccc"; // Altera a cor do botão
            bookmarkletLink.style.color = "#666"; // Altera a cor do texto
        }, 90000); // 90 segundos
        </script>';

        exit; // Evita carregar qualquer outro template
    }
}

// Adiciona a configuração de credenciais do administrador na área de administração
add_action('admin_menu', 'etiquetas_correios_admin_menu');
function etiquetas_correios_admin_menu() {
    add_menu_page(
        __('Configurações Etiquetas Correios', 'etiquetas-correios'),
        __('Etiquetas Correios', 'etiquetas-correios'),
        'manage_options',
        'etiquetas-correios-settings',
        'etiquetas_correios_settings_page'
    );
}

// Função para exibir a página de configurações
function etiquetas_correios_settings_page() {
    include plugin_dir_path(__FILE__) . 'views/configuracoes.php';
}

// Registra as opções de configurações
add_action('admin_init', 'etiquetas_correios_register_settings');
function etiquetas_correios_register_settings() {
    register_setting('etiquetas-correios-settings-group', 'etiquetas_correios_username');
    register_setting('etiquetas-correios-settings-group', 'etiquetas_correios_password');
}
