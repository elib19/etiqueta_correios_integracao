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
            'remnom'    => $data['remnom'],
            'remend'    => $data['remend'],
            'remnum'    => $data['remnum'],
            'remcom'    => $data['remcom'],
            'rembai'    => $data['rembai'],
            'remcid'    => $data['remcid'],
            'remest'    => $data['remest'],
            'remcep'    => $data['remcep'],
            'remcpf'    => $data['remcpf'],
        )
    );
}
