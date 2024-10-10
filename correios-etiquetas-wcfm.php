<?php
/*
Plugin Name: Correios WCFM Integration
Description: Integração de etiquetas dos Correios com WCFM, onde o administrador configura as credenciais e os vendedores geram as etiquetas.
Version: 1.0
Author: Eli Silva
*/

if (!defined('ABSPATH')) {
    exit; // Sair se acessado diretamente
}

// Define as constantes do plugin
define('CORREIOS_WCFM_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CORREIOS_WCFM_PLUGIN_URL', plugin_dir_url(__FILE__));

// Inclui os arquivos necessários
include_once CORREIOS_WCFM_PLUGIN_PATH . 'includes/class-correios-helper.php';
include_once CORREIOS_WCFM_PLUGIN_PATH . 'includes/class-correios-settings.php';
include_once CORREIOS_WCFM_PLUGIN_PATH . 'includes/class-correios-install.php';
include_once CORREIOS_WCFM_PLUGIN_PATH . 'includes/class-correios-uninstall.php';
include_once CORREIOS_WCFM_PLUGIN_PATH . 'hooks/admin-hooks.php';
include_once CORREIOS_WCFM_PLUGIN_PATH . 'hooks/frontend-hooks.php';
include_once CORREIOS_WCFM_PLUGIN_PATH . 'hooks/wcfm-hooks.php';

// Verifica se WooCommerce e WCFM estão ativos
add_action('plugins_loaded', 'correios_wcfm_check_dependencies');
function correios_wcfm_check_dependencies() {
    if ( !class_exists('WooCommerce') || !class_exists('WCFMmp') ) {
        add_action('admin_notices', 'correios_wcfm_missing_dependencies_notice');
        deactivate_plugins(plugin_basename(__FILE__));
    } else {
        correios_wcfm_init();
    }
}

function correios_wcfm_missing_dependencies_notice() {
    echo '<div class="error"><p><strong>Correios WCFM Integration:</strong> Este plugin requer WooCommerce e WCFM Marketplace ativos para funcionar corretamente.</p></div>';
}

// Inicializa as configurações e funções do plugin
function correios_wcfm_init() {
    Correios_Settings::init();
}

// Ativa o plugin
register_activation_hook(__FILE__, array('Correios_Install', 'install'));

// Desativa o plugin
register_uninstall_hook(__FILE__, array('Correios_Uninstall', 'uninstall'));

// Enfileirar os estilos CSS e scripts JS
function correios_enqueue_assets() {
    wp_enqueue_style('correios-admin-styles', plugin_dir_url(__FILE__) . 'assets/css/correios-styles.css');
    wp_enqueue_script('correios-scripts', plugin_dir_url(__FILE__) . 'assets/js/correios-scripts.js', array('jquery'), false, true);
}
add_action('admin_enqueue_scripts', 'correios_enqueue_assets');
add_action('wp_enqueue_scripts', 'correios_enqueue_assets');
?>
