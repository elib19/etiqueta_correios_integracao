<?php

class Correios_Uninstall {

    public static function uninstall() {
        // Remover as opções criadas durante a instalação
        delete_option( 'correios_user' );
        delete_option( 'correios_cartao' );
        delete_option( 'correios_api_key' );
    }
}
