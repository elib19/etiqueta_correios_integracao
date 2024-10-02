<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Função auxiliar para gerar etiquetas
function correios_generate_label( $order_id ) {
    // Recuperar configurações da API e do contrato
    $api_key = get_option( 'correios_api_key' );
    $contract_number = get_option( 'correios_contract_number' );

    if ( empty( $api_key ) || empty( $contract_number ) ) {
        return new WP_Error( 'missing_config', 'A API ou o número do contrato não estão configurados.' );
    }

    // Recuperar informações do pedido
    $order = wc_get_order( $order_id );
    if ( !$order ) {
        return new WP_Error( 'invalid_order', 'Pedido inválido.' );
    }

    // Informações do destinatário
    $recipient = array(
        'name'          => $order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name(),
        'address'       => $order->get_shipping_address_1(),
        'address_2'     => $order->get_shipping_address_2(),
        'city'          => $order->get_shipping_city(),
        'postcode'      => $order->get_shipping_postcode(),
        'state'         => $order->get_shipping_state(),
        'country'       => $order->get_shipping_country(),
        'phone'         => $order->get_billing_phone(),
        'email'         => $order->get_billing_email(),
    );

    // Detalhes do pacote
    $package_details = array(
        'weight'        => wc_get_weight( $order->get_meta( '_shipping_weight' ), 'kg' ), // Peso do pacote
        'length'        => wc_get_dimension( $order->get_meta( '_shipping_length' ), 'cm' ), // Comprimento
        'width'         => wc_get_dimension( $order->get_meta( '_shipping_width' ), 'cm' ), // Largura
        'height'        => wc_get_dimension( $order->get_meta( '_shipping_height' ), 'cm' ), // Altura
        'value'         => $order->get_total(), // Valor total do pedido
    );

    // Criar corpo da requisição para a API
    $api_data = array(
        'api_key'           => $api_key,
        'contract_number'   => $contract_number,
        'order_id'          => $order_id,
        'recipient'         => $recipient,
        'package_details'   => $package_details,
    );

    // URL da API dos Correios (Substitua pela URL real)
    $api_url = 'https://api.correios.com.br/etiquetas';

    // Fazer requisição à API dos Correios para gerar a etiqueta
    $response = wp_remote_post( $api_url, array(
        'method'    => 'POST',
        'body'      => json_encode( $api_data ),
        'headers'   => array(
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $api_key,
        ),
    ) );

    // Verificar se a requisição foi bem-sucedida
    if ( is_wp_error( $response ) ) {
        return new WP_Error( 'api_error', 'Erro ao conectar à API dos Correios: ' . $response->get_error_message() );
    }

    $body = wp_remote_retrieve_body( $response );
    $result = json_decode( $body, true );

    // Verificar se houve erro na resposta da API
    if ( isset( $result['error'] ) ) {
        return new WP_Error( 'api_error', 'Erro da API dos Correios: ' . $result['error'] );
    }

    // Retornar o código da etiqueta gerada
    if ( isset( $result['label_code'] ) ) {
        return $result['label_code']; // Código da etiqueta gerada
    }

    return new WP_Error( 'label_generation_failed', 'Falha ao gerar a etiqueta.' );
}
