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

// Ativa o plugin
register_activation_hook(__FILE__, array('Correios_Install', 'install'));

// Desativa o plugin
register_uninstall_hook(__FILE__, array('Correios_Uninstall', 'uninstall'));

// Inicializa as configurações e funções do plugin
add_action('plugins_loaded', 'correios_wcfm_init');
function correios_wcfm_init() {
    if (class_exists('WCFMmp')) {
        Correios_Settings::init();
    }
}
