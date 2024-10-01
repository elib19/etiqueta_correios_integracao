<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function correios_get_vendor_data( $vendor_id ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'correios_vendor_data';

    $query = $wpdb->prepare( "SELECT * FROM $table_name WHERE vendor_id = %d", $vendor_id );
    return $wpdb->get_row( $query );
}

function correios_save_vendor_data( $vendor_id, $data ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'correios_vendor_data';

    $existing = correios_get_vendor_data( $vendor_id );

    if ( $existing ) {
        $wpdb->update(
            $table_name,
            $data,
            array( 'vendor_id' => $vendor_id ),
            array(
                '%s', '%s', '%s', '%s', '%s',
                '%s', '%s', '%s', '%s'
            ),
            array( '%d' )
        );
    } else {
        $data['vendor_id'] = $vendor_id;
        $wpdb->insert(
            $table_name,
            $data,
            array(
                '%d', '%s', '%s', '%s', '%s', '%s',
                '%s', '%s', '%s', '%s'
            )
        );
    }
}
