<?php
/**
 * Plugin Name: Correios WCFM Integration
 * Description: Integração de etiquetas dos Correios com WCFM.
 * Version: 1.0.0
 * Author: Eli Silva
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Correios_WCFM_Integration {
    
    public function __construct() {
        add_action('init', array($this, 'register_scripts'));
        add_action('wcfm_menu', array($this, 'add_correios_menu'), 25);
    }

    public function register_scripts() {
        wp_register_script('correios_wcfm_js', plugin_dir_url(__FILE__) . 'assets/js/correios-wcfm.js', array('jquery'), '1.0', true);
        wp_register_style('correios_wcfm_css', plugin_dir_url(__FILE__) . 'assets/css/correios-wcfm.css', array(), '1.0');
    }

    public function add_correios_menu($menus) {
        $menus['correios-etiquetas'] = array(
            'label' => __('Gerar Etiquetas', 'correios-wcfm-integration'),
            'url' => get_wcfm_page(), // Página do WCFM que será usada
            'icon' => 'wcfmfa fa-truck',
            'priority' => 55
        );

        return $menus;
    }
}

new Correios_WCFM_Integration();

