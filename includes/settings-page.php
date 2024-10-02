<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Adiciona a página de configurações como uma subpágina no menu do WCFM
function correios_add_admin_menu() {
    add_submenu_page(
        'wcfm',
        'Configurações Correios',
        'Correios',
        'manage_options',
        'correios_settings',
        'correios_settings_page'
    );
}
add_action( 'admin_menu', 'correios_add_admin_menu' );

// Função para inicializar as configurações
function correios_settings_init() {
    register_setting( 'correios_options_group', 'correios_api_key' ); // Registra o campo da API
    register_setting( 'correios_options_group', 'correios_cartao' ); // Registra o campo do número do cartão
}
add_action( 'admin_init', 'correios_settings_init' );

// Renderiza a página de configurações
function correios_settings_page() {
    ?>
    <div class="wrap">
        <h1>Configurações do Plugin Correios</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'correios_options_group' ); // Gera os campos de segurança
            do_settings_sections( 'correios_settings' ); // Gera as seções da configuração

            // Obter as opções armazenadas
            $api_key = get_option( 'correios_api_key' );
            $correios_cartao = get_option( 'correios_cartao' );
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">API Key:</th>
                    <td><input type="text" name="correios_api_key" value="<?php echo esc_attr( $api_key ); ?>" class="regular-text" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Número do Cartão Correios Fácil:</th>
                    <td><input type="text" name="correios_cartao" value="<?php echo esc_attr( $correios_cartao ); ?>" class="regular-text" /></td>
                </tr>
            </table>
            <?php submit_button(); // Botão de salvar ?>
        </form>
    </div>
    <?php
}
