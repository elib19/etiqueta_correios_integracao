<?php

if (!defined('ABSPATH')) {
    exit;
}

class Correios_Helper {

    public static function gerarEtiqueta($destinatario, $endereco, $cidade, $estado, $cep) {
        $usuario = get_option('correios_wcfm_usuario');
        $cartao = get_option('correios_wcfm_cartao');
        $api_key = get_option('correios_wcfm_api_key');

        if (empty($usuario) || empty($cartao) || empty($api_key)) {
            return new WP_Error('missing_credentials', __('Credenciais dos Correios não configuradas.', 'correios-wcfm-integration'));
        }

        $dados_etiqueta = array(
            'usuario'      => $usuario,
            'cartao'       => $cartao,
            'api_key'      => $api_key,
            'destinatario' => $destinatario,
            'endereco'     => $endereco,
            'cidade'       => $cidade,
            'estado'       => $estado,
            'cep'          => $cep,
        );

        $api_url = 'https://api.correios.com/v1/gerar_etiqueta';
        $response = wp_remote_post($api_url, array(
            'body'    => json_encode($dados_etiqueta),
            'headers' => array(
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer ' . $api_key
            ),
        ));

        if (is_wp_error($response)) {
            return $response;
        }

        $response_body = wp_remote_retrieve_body($response);
        $result = json_decode($response_body, true);

        if (isset($result['erro'])) {
            return new WP_Error('api_error', __('Erro ao gerar a etiqueta: ' . $result['erro'], 'correios-wcfm-integration'));
        }

        return $result['etiqueta_url'];
    }
}
?>
