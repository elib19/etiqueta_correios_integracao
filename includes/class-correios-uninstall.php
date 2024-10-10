<?php

if (!defined('ABSPATH')) {
    exit;
}

class Correios_Uninstall {

    public static function uninstall() {
        // Remove as opções salvas ao desinstalar o plugin
        delete_option('correios_wcfm_usuario');
        delete_option('correios_wcfm_cartao');
        delete_option('correios_wcfm_api_key');
    }
}
