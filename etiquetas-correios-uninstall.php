<?php
// Se este arquivo for acessado diretamente, saia.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Remover opções do banco de dados
delete_option('etiquetas_correios_username'); // Nome de usuário dos Correios
delete_option('etiquetas_correios_password'); // Senha dos Correios

// Se você tiver outras opções, remova-as aqui
// delete_option('etiquetas_correios_outra_opcao');
