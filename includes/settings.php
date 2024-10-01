<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Exibe a página de configurações do administrador
function correios_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( isset( $_POST['submit'] ) ) {
        update_option( 'correios_api_key', sanitize_text_field( $_POST['correios_api_key'] ) );
        update_option( 'correios_contract_number', sanitize_text_field( $_POST['correios_contract_number'] ) );
        echo '<div class="notice notice-success is-dismissible"><p>Configurações salvas!</p></div>';
    }

    $api_key = get_option( 'correios_api_key', '' );
    $contract_number = get_option( 'correios_contract_number', '' );

    ?>
    <div class="wrap">
        <h1>Configurações do Correios</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="correios_api_key">Chave da API</label></th>
                    <td><input type="text" name="correios_api_key" id="correios_api_key" value="<?php echo esc_attr( $api_key ); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="correios_contract_number">Número do Contrato</label></th>
                    <td><input type="text" name="correios_contract_number" id="correios_contract_number" value="<?php echo esc_attr( $contract_number ); ?>" class="regular-text"></td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="Salvar Configurações">
            </p>
        </form>
    </div>
    <?php
}
