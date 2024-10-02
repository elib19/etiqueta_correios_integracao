<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<div class="wrap">
    <h1>Configurações do Plugin Correios</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields( 'correios_options_group' );
        do_settings_sections( 'correios_settings' );

        // Obter as opções armazenadas
        $api_key = get_option( 'correios_api_key' );
        $correios_cartao = get_option( 'correios_cartao' );
        ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">API Key:</th>
                <td><input type="text" name="correios_api_key" value="<?php echo esc_attr( $api_key ); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Número do Cartão Correios Fácil:</th>
                <td><input type="text" name="correios_cartao" value="<?php echo esc_attr( $correios_cartao ); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
