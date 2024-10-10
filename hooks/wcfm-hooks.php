<?php

// Hook para adicionar o menu ao WCFM
add_filter('wcfm_menus', 'correios_wcfm_menu', 50);
function correios_wcfm_menu($menus) {
    // Verifica se o usuário é um vendedor
    if (wcfm_is_vendor()) {
        // Adiciona a nova opção de menu
        $menus['correios-etiquetas'] = array(
            'label'    => __('Gerar Etiqueta Correios', 'correios-wcfm-integration'),
            'url'      => wcfm_get_endpoint_url('correios-etiquetas'), // Corrigido para usar o slug correto
            'icon'     => 'envelope',
            'priority' => 75
        );
    }
    return $menus;
}

// Adicionar o endpoint ao WCFM
add_filter('wcfm_get_endpoint_url', 'correios_wcfm_get_endpoint_url', 50, 2);
function correios_wcfm_get_endpoint_url($url, $endpoint) {
    // Verifica se o endpoint é o correto
    if ($endpoint === 'correios-etiquetas') {
        return admin_url('admin.php?page=correios-etiquetas'); // Corrigido para o endpoint correto
    }
    return $url;
}

// Hook para exibir o conteúdo da página de etiquetas
add_action('wcfm_endpoint_content_correios-etiquetas', 'correios_wcfm_etiquetas_content');
function correios_wcfm_etiquetas_content() {
    // Incluindo a view que contém o formulário para gerar a etiqueta
    include_once plugin_dir_path(__FILE__) . '../templates/correios-wcfm-view.php';
}
