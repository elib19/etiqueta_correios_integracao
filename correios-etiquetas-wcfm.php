<?php
/*
Plugin Name: Correios Etiquetas WCFM
Description: Plugin para emissão de etiquetas dos Correios compatível com WooCommerce e WCFM.
Version: 1.0
Author: Seu Nome
*/

// Evita o acesso direto ao arquivo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define constantes do plugin
define( 'CEWCFM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Inclui arquivos necessários
require_once CEWCFM_PLUGIN_DIR . 'includes/install.php';
require_once CEWCFM_PLUGIN_DIR . 'includes/uninstall.php';
require_once CEWCFM_PLUGIN_DIR . 'includes/admin-settings.php';
require_once CEWCFM_PLUGIN_DIR . 'includes/label-generation.php';
require_once CEWCFM_PLUGIN_DIR . 'includes/wcfm-hooks.php';

// Função de ativação
function cewcfm_activate() {
    cewcfm_install();
}
register_activation_hook( __FILE__, 'cewcfm_activate' );

// Adiciona menu ao painel do admin
add_action('admin_menu', 'cewcfm_admin_menu');
function cewcfm_admin_menu() {
    add_menu_page('Correios Etiquetas', 'Correios Etiquetas', 'manage_options', 'correios-etiquetas', 'cewcfm_settings_page');
}

// Função para a página de configurações
function cewcfm_settings_page() {
    ?>
    <div class="wrap">
        <h1>Configurações do Correios Etiquetas</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('cewcfm_options_group');
            do_settings_sections('cewcfm_options_group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Usuário Correios</th>
                    <td><input type="text" name="cewcfm_correios_user" value="<?php echo esc_attr(get_option('cewcfm_correios_user')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Cartão Correios Fácil</th>
                    <td><input type="text" name="cewcfm_correios_card" value="<?php echo esc_attr(get_option('cewcfm_correios_card')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Chave API</th>
                    <td><input type="text" name="cewcfm_correios_api_key" value="<?php echo esc_attr(get_option('cewcfm_correios_api_key')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Registra as configurações
add_action('admin_init', 'cewcfm_register_settings');
function cewcfm_register_settings() {
    register_setting('cewcfm_options_group', 'cewcfm_correios_user');
    register_setting('cewcfm_options_group', 'cewcfm_correios_card');
    register_setting('cewcfm_options_group', 'cewcfm_correios_api_key');
}
?>
