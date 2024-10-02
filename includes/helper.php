<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function correios_save_vendor_data( $vendor_id, $data ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'correios_vendors';

    $wpdb->replace(
        $table_name,
        array(
            'vendor_id' => $vendor_id,
            'remnom'    => sanitize_text_field( $data['remnom'] ),
            'remend'    => sanitize_text_field( $data['remend'] ),
            'remnum'    => sanitize_text_field( $data['remnum'] ),
            'remcom'    => sanitize_text_field( $data['remcom'] ),
            'rembai'    => sanitize_text_field( $data['rembai'] ),
            'remcid'    => sanitize_text_field( $data['remcid'] ),
            'remest'    => sanitize_text_field( $data['remest'] ),
            'remcep'    => sanitize_text_field( $data['remcep'] ),
            'remcpf'    => sanitize_text_field( $data['remcpf'] ),
        )
    );
}
