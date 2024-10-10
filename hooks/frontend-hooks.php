<?php
// hooks/frontend-hooks.php

// Adiciona um menu para "Gerar Etiquetas" no painel do vendedor no WCFM
add_filter('wcfm_menus', 'correios_wcfm_menu', 30);
function correios_wcfm_menu($menus) {
    if (wcfm_is_vendor()) {
        $menus['correios-etiquetas'] = array(
            'label'    => __('Gerar Etiqueta Correios', 'correios-wcfm'),
            'url'      => wcfm_get_endpoint_url('correios-etiquetas'),
            'icon'     => 'envelope',
            'priority' => 75
        );
    }
    return $menus;
}

// Adiciona o endpoint para a página de geração de etiquetas
add_action('init', 'correios_add_wcfm_endpoints');
function correios_add_wcfm_endpoints() {
    add_rewrite_endpoint('correios-etiquetas', EP_PAGES);
}

// Exibe o conteúdo da página de geração de etiquetas no painel do vendedor
add_action('wcfm_load_views', 'correios_wcfm_etiquetas_page');
function correios_wcfm_etiquetas_page($view) {
    global $WCFM, $wp_query;

    if (isset($wp_query->query_vars['correios-etiquetas'])) {
        $WCFM->template->get_template('correios-wcfm-view.php', array());
    }
}

// Adiciona as permissões para que o vendedor possa ver o menu
add_filter('wcfm_query_vars', 'correios_wcfm_query_vars', 50);
function correios_wcfm_query_vars($query_vars) {
    $query_vars['correios-etiquetas'] = 'correios-etiquetas';
    return $query_vars;
}

// Garante que o endpoint seja registrado no WCFM
add_filter('wcfm_endpoint_title', 'correios_wcfm_endpoint_title', 50, 2);
function correios_wcfm_endpoint_title($title, $endpoint) {
    if ($endpoint == 'correios-etiquetas') {
        $title = __('Gerar Etiqueta Correios', 'correios-wcfm');
    }
    return $title;
}

// Adiciona o conteúdo ao template principal do WCFM para vendedores
add_action('after_wcfm_load_views', 'correios_wcfm_add_to_template');
function correios_wcfm_add_to_template() {
    global $wp;
    if (isset($wp->query_vars['correios-etiquetas'])) {
        include_once plugin_dir_path(__FILE__) . '../views/correios-wcfm-view.php';
    }
}
