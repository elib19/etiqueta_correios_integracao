<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function correios_uninstall() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'correios_vendors';
    $wpdb->query( "DROP TABLE IF EXISTS $table_name" );
}
