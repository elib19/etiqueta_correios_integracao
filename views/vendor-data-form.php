<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Processar o formulário se ele foi enviado
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    // Verifica se o usuário é um vendedor
    if ( ! wcfm_is_vendor() ) {
        return;
    }

    // Sanitizar e processar os dados do vendedor
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
    );

    $vendor_id = get_current_user_id();

    // Salvar os dados do vendedor
    correios_save_vendor_data( $vendor_id, $data );

    // Mensagem de sucesso
    echo '<div class="notice notice-success">Dados salvos com sucesso!</div>';
}
?>

<div class="wrap">
    <h2>Dados do Remetente</h2>
    <form method="post">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Nome:</th>
                <td><input type="text" id="remnom" name="remnom" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">Endereço:</th>
                <td><input type="text" id="remend" name="remend" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">Número:</th>
                <td><input type="text" id="remnum" name="remnum" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">Complemento:</th>
                <td><input type="text" id="remcom" name="remcom" class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">Bairro:</th>
                <td><input type="text" id="rembai" name="rembai" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">Cidade:</th>
                <td><input type="text" id="remcid" name="remcid" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">Estado:</th>
                <td><input type="text" id="remest" name="remest" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">CEP:</th>
                <td><input type="text" id="remcep" name="remcep" required class="regular-text"></td>
            </tr>
            <tr valign="top">
                <th scope="row">CPF/CNPJ:</th>
                <td><input type="text" id="remcpf" name="remcpf" class="regular-text"></td>
            </tr>
        </table>
        
        <?php submit_button( 'Salvar Dados' ); // Botão de salvar ?>
    </form>
</div>
