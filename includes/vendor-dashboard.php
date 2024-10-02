<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function correios_vendor_dashboard() {
    if ( ! wcfm_is_vendor() ) {
        return;
    }

    // Processa o formulário quando enviado
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
        $data = array(
            'remnom' => sanitize_text_field( $_POST['remnom'] ),
            'remend' => sanitize_text_field( $_POST['remend'] ),
            'remnum' => sanitize_text_field( $_POST['remnum'] ),
            'remcom' => sanitize_text_field( $_POST['remcom'] ),
            'rembai' => sanitize_text_field( $_POST['rembai'] ),
            'remcid' => sanitize_text_field( $_POST['remcid'] ),
            'remest' => sanitize_text_field( $_POST['remest'] ),
            'remcep' => sanitize_text_field( $_POST['remcep'] ),
            'remcpf' => sanitize_text_field( $_POST['remcpf'] ),
            'correios_cartao' => sanitize_text_field( $_POST['correios_cartao'] ), // Campo para o cartão
        );
         
        // salva os dados do vendedor
        correios_save_vendor_data( $vendor_id, $data );

        echo '<div class="notice notice-success">Dados salvos com sucesso!</div>';
    }

    // Obtém os dados existentes do vendedor
    $vendor_data = correios_get_vendor_data( $vendor_id );

    include plugin_dir_path( __FILE__ ) . '../views/vendor-data-form.php';
    include plugin_dir_path( __FILE__ ) . '../views/settings-page.php';
    
}

// Função para obter os dados do vendedor
function correios_get_vendor_data( $vendor_id ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'correios_vendors';

    return $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE vendor_id = %d", $vendor_id ), ARRAY_A );
}
