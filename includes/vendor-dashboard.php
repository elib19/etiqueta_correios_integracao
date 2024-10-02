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

        $vendor_id = get_current_user_id();
        correios_save_vendor_data( $vendor_id, $data );

        echo '<div class="notice notice-success">Dados salvos com sucesso!</div>';
    }

    include plugin_dir_path( __FILE__ ) . '../views/vendor-data-form.php';
}
