<?php

class Correios_Install {

    public static function install() {
        // Criar opções padrão para as credenciais
        if ( ! get_option( 'correios_user' ) ) {
            update_option( 'correios_user', '' );
        }

        if ( ! get_option( 'correios_cartao' ) ) {
            update_option( 'correios_cartao', '' );
        }

        if ( ! get_option( 'correios_api_key' ) ) {
            update_option( 'correios_api_key', '' );
        }
    }
}
