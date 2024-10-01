<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function correios_install() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'correios_vendors';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        vendor_id bigint(20) NOT NULL,
        remnom varchar(255) NOT NULL,
        remend varchar(255) NOT NULL,
        remnum varchar(50) NOT NULL,
        remcom varchar(255),
        rembai varchar(255) NOT NULL,
        remcid varchar(255) NOT NULL,
        remest varchar(255) NOT NULL,
        remcep varchar(20) NOT NULL,
        remcpf varchar(20) NOT NULL,
        PRIMARY KEY (vendor_id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
