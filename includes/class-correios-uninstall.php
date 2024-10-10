<?php

if (!defined('ABSPATH')) {
    exit; // Sair se acessado diretamente
}

class Correios_Uninstall {

    public static function uninstall() {
        // Remove as opções do banco de dados ao desinstalar o plugin
        delete_option('correios_wcfm_usuario');
        delete_option('correios_wcfm_cartao');
        delete_option('correios_wcfm_api_key');

        // Você pode adicionar outras operações de limpeza de banco de dados aqui, se necessário
    }
}
