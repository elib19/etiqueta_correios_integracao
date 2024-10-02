<?php

class Correios_Helper {

    public static function init() {
        add_action( 'wcfmmp_store_before_main_content', array( __CLASS__, 'generate_label_interface' ) );
    }

    public static function generate_label_interface() {
        if( ! wcfm_is_vendor() ) return; // Garantir que apenas vendedores tenham acesso

        include CORREIOS_WCFM_PATH . 'includes/views/correios-generate-label-view.php';
    }

    public static function generate_label( $data ) {
        $user_correios = get_option( 'correios_user' );
        $cartao_correios = get_option( 'correios_cartao' );
        $api_key_correios = get_option( 'correios_api_key' );

        // Chamada à API dos Correios para gerar a etiqueta (implementação fictícia)
        $response = wp_remote_post( 'https://api.correios.com.br/etiquetas', array(
            'body' => json_encode( array(
                'user'     => $user_correios,
                'cartao'   => $cartao_correios,
                'api_key'  => $api_key_correios,
                'data'     => $data
            ) ),
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
        ));

        if( is_wp_error( $response ) ) {
            return false;
        }

        return json_decode( wp_remote_retrieve_body( $response ), true );
    }
}
