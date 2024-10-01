<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function correios_install() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name = $wpdb->prefix . 'correios_vendor_data';

    $sql = "CREATE TABLE $table_name (
        vendor_id BIGINT(20) UNSIGNED NOT NULL,
        remnom VARCHAR(100) NOT NULL,
        remend VARCHAR(255) NOT NULL,
        remnum VARCHAR(20) NOT NULL,
        remcom VARCHAR(50),
        rembai VARCHAR(100) NOT NULL,
        remcid VARCHAR(100) NOT NULL,
        remest VARCHAR(2) NOT NULL,
        remcep VARCHAR(9) NOT NULL,
        remcpf VARCHAR(20) NOT NULL,
        PRIMARY KEY  (vendor_id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'correios_version', '1.0.0' );
}

function correios_populate_initial_data() {
    if ( get_option( 'correios_version' ) === false ) {
        update_option( 'correios_version', '1.0.0' );
    }
}

function correios_update_check() {
    $current_version = get_option( 'correios_version' );
    $new_version = '1.0.0';

    if ( version_compare( $current_version, $new_version, '<' ) ) {
        correios_install();
        update_option( 'correios_version', $new_version );
    }
}
