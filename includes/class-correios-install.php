<?php

if (!defined('ABSPATH')) {
    exit; // Sair se acessado diretamente
}

class Correios_Install {

    public static function install() {
        // Adiciona as opções padrão para o plugin
        if ( ! get_option('correios_wcfm_usuario') ) {
            add_option('correios_wcfm_usuario', '');
        }

        if ( ! get_option('correios_wcfm_cartao') ) {
            add_option('correios_wcfm_cartao', '');
        }

        if ( ! get_option('correios_wcfm_api_key') ) {
            add_option('correios_wcfm_api_key', '');
        }

        // Você pode adicionar qualquer outra configuração ou operação que precise ser feita na instalação do plugin
    }
}
?>
