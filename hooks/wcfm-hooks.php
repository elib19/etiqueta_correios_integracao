<?php
// hooks/wcfm-hooks.php

// Verifica se o WCFM está ativo e carregado
if (!function_exists('wcfm_is_vendor')) {
    return;
}

// Hook para adicionar o menu ao WCFM
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

// Adiciona o novo endpoint "correios-etiquetas"
add_action('init', 'correios_add_wcfm_endpoints');
function correios_add_wcfm_endpoints() {
    add_rewrite_endpoint('correios-etiquetas', EP_ROOT | EP_PAGES);
}

// Carrega a view da página de etiquetas no frontend do WCFM
add_action('wcfm_load_views', 'correios_wcfm_etiquetas_page');
function correios_wcfm_etiquetas_page() {
    global $WCFM, $wp_query;

    // Verifica se o endpoint de "correios-etiquetas" foi acessado
    if (isset($wp_query->query_vars['correios-etiquetas'])) {
        $WCFM->template->get_template('correios-wcfm-view.php', array());
    }
}
