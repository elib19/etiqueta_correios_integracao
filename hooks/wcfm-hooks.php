<?php
// hooks/wcfm-hooks.php

// Garante que o código será executado após o WCFM estar totalmente carregado
add_action('init', 'correios_wcfm_hooks');
function correios_wcfm_hooks() {
    // Verifica se o WCFM está ativo antes de adicionar o menu
    if (function_exists('wcfm_is_vendor')) {

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

        // Hook para adicionar o endpoint
        add_action('init', 'correios_add_wcfm_endpoints');
        function correios_add_wcfm_endpoints() {
            add_rewrite_endpoint('correios-etiquetas', EP_PAGES);
        }

        // Hook para carregar a view da página de etiquetas
        add_action('wcfm_load_views', 'correios_wcfm_etiquetas_page');
        function correios_wcfm_etiquetas_page($view) {
            global $WCFM, $wp_query;

            if (isset($wp_query->query_vars['correios-etiquetas'])) {
                $WCFM->template->get_template('correios-wcfm-view.php', array());
            }
        }
    }
}
