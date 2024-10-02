<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Adiciona menu de configurações
function correios_add_admin_menu() {
    add_menu_page(
        'Configurações Correios',
        'Correios',
        'manage_options',
        'correios_settings',
        'correios_settings_page'
    );
}
add_action( 'admin_menu', 'correios_add_admin_menu' );

function correios_settings_page() {
    ?>
    <div class="wrap">
        <h1>Configurações do Plugin Correios</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'correios_options_group' );
            do_settings_sections( 'correios_settings' );

            $api_key = get_option( 'correios_api_key' );
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">API Key:</th>
                    <td><input type="text" name="correios_api_key" value="<?php echo esc_attr( $api_key ); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

add_action( 'admin_init', 'correios_settings_init' );

function correios_settings_init() {
    register_setting( 'correios_options_group', 'correios_api_key' );
}
