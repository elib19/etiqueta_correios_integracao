<?php
// hooks/admin-hooks.php

// Adiciona uma página de configurações para o plugin Correios no painel do administrador
add_action('admin_menu', 'correios_admin_menu');
function correios_admin_menu() {
    add_menu_page(
        __('Configurações Correios', 'correios-wcfm'),  // Título da página
        __('Correios', 'correios-wcfm'),                // Título do menu
        'manage_options',                               // Capacidade
        'correios-settings',                            // Slug
        'correios_admin_settings_page',                 // Função para exibir a página
        'dashicons-admin-generic',                      // Ícone
        65                                              // Posição no menu
    );
}

// Função para renderizar a página de configurações do administrador
function correios_admin_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Configurações de Integração dos Correios', 'correios-wcfm'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('correios_settings_group');
            do_settings_sections('correios-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Registra as configurações da API dos Correios no painel do administrador
add_action('admin_init', 'correios_admin_settings');
function correios_admin_settings() {
    // Seção das configurações
    add_settings_section(
        'correios_section', 
        __('Credenciais da API dos Correios', 'correios-wcfm'), 
        null, 
        'correios-settings'
    );

    // Campo de usuário dos Correios
    add_settings_field(
        'correios_user', 
        __('Usuário dos Correios', 'correios-wcfm'), 
        'correios_user_callback', 
        'correios-settings', 
        'correios_section'
    );
    register_setting('correios_settings_group', 'correios_user');

        // Campo do Cartão Correios Fácil
    add_settings_field(
        'correios_cartao', 
        __('Cartão Correios Fácil', 'correios-wcfm'), 
        'correios_cartao_callback', 
        'correios-settings', 
        'correios_section'
    );
    register_setting('correios_settings_group', 'correios_cartao');

    // Campo da API Key dos Correios
    add_settings_field(
        'correios_api_key', 
        __('Chave API dos Correios', 'correios-wcfm'), 
        'correios_api_key_callback', 
        'correios-settings', 
        'correios_section'
    );
    register_setting('correios_settings_group', 'correios_api_key');
}

// Callbacks para os campos de entrada
function correios_user_callback() {
    $user = get_option('correios_user');
    echo "<input type='text' name='correios_user' value='" . esc_attr($user) . "' />";
}

function correios_cartao_callback() {
    $cartao = get_option('correios_cartao');
    echo "<input type='text' name='correios_cartao' value='" . esc_attr($cartao) . "' />";
}

function correios_api_key_callback() {
    $api_key = get_option('correios_api_key');
    echo "<input type='text' name='correios_api_key' value='" . esc_attr($api_key) . "' />";
}
?>
