<?php
// hooks/wcfm-hooks.php

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
?>
