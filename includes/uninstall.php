<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

global $wpdb;

$table_name = $wpdb->prefix . 'correios_vendor_data';
$wpdb->query( "DROP TABLE IF EXISTS $table_name" );

delete_option( 'correios_version' );
