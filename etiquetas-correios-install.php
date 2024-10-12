<?php
// Função de ativação
register_activation_hook(__FILE__, 'etiquetas_correios_install');
function etiquetas_correios_install() {
    // Adiciona opções padrão no ativar o plugin
    add_option('etiquetas_correios_username', '');
    add_option('etiquetas_correios_password', '');
}

// Função de desativação
register_uninstall_hook(__FILE__, 'etiquetas_correios_uninstall');
function etiquetas_correios_uninstall() {
    // Remove as opções ao desinstalar o plugin
    delete_option('etiquetas_correios_username');
    delete_option('etiquetas_correios_password');
}
