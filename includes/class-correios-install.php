<?php

if (!defined('ABSPATH')) {
    exit;
}

class Correios_Install {

    public static function install() {
        // Aqui você pode adicionar as opções padrão para o plugin
        add_option('correios_wcfm_usuario', '');
        add_option('correios_wcfm_cartao', '');
        add_option('correios_wcfm_api_key', '');
    }
}
