<?php
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
        $WCFM->template->get_template('virtuaria-wcfm-view.php', array());
    }
}
?>
