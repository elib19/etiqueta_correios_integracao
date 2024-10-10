<?php
// hooks/frontend-hooks.php

// Adiciona um menu para "Gerar Etiquetas" no painel do vendedor no WCFM
add_filter('wcfm_menus', 'correios_wcfm_menu', 50);
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

// Renderiza a página de geração de etiquetas no painel do vendedor
add_action('wcfm_load_views', 'correios_wcfm_etiquetas_page');
function correios_wcfm_etiquetas_page($view) {
    global $WCFM, $wp_query;

    if (isset($wp_query->query_vars['correios-etiquetas'])) {
        $WCFM->template->get_template('correios-wcfm-view.php', array());
    }
}
?>
