<?php
// Hook para adicionar o menu ao WCFM
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

// Adiciona o endpoint para a página de geração de etiquetas
add_action('init', 'virtuaria_add_wcfm_endpoints');
function virtuaria_add_wcfm_endpoints() {
    add_rewrite_endpoint('virtuaria-etiquetas', EP_PAGES);
    flush_rewrite_rules();
}

// Renderiza a página de geração de etiquetas no painel do vendedor
add_action('template_redirect', 'virtuaria_wcfm_template_redirect');
function virtuaria_wcfm_template_redirect() {
    global $wp_query;

    if (isset($wp_query->query_vars['virtuaria-etiquetas'])) {
        require_once plugin_dir_path(__FILE__) . '../views/virtuaria-wcfm-view.php';
        exit;
    }
}
