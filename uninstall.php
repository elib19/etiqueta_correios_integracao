<?php
// Se este arquivo for acessado diretamente, impede a execução
if (!defined('ABSPATH')) {
    exit;
}

// Função de desinstalação do plugin
function virtuaria_correios_uninstall() {
    // Remove as opções do banco de dados
    delete_option('virtuaria_correios_api_key');
    delete_option('virtuaria_correios_usuario');
    delete_option('virtuaria_correios_cartao');
}

// Chama a função de desinstalação
virtuaria_correios_uninstall();
