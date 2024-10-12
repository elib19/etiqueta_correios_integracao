<?php
/*
Plugin Name: Etiquetas Correios WCFM
Description: Permite que administradores insiram credenciais dos Correios e que vendedores gerem etiquetas no WCFM.
Version: 1.0
Author: Seu Nome
*/

// Evita acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

// Hook para adicionar o menu ao WCFM
add_filter('wcfm_menus', 'etiquetas_correios_wcfm_menu', 50);
function etiquetas_correios_wcfm_menu($menus) {
    if (wcfm_is_vendor()) {
        $menus['etiquetas-correios'] = array(
            'label'    => __('Gerar Etiquetas Correios', 'etiquetas-correios'),
            'url'      => wcfm_get_endpoint_url('etiquetas-correios'),
            'icon'     => 'envelope',
            'priority' => 75
        );
    }
}

// Adiciona o endpoint para a página de redirecionamento
add_action('init', 'etiquetas_add_wcfm_endpoints');
function etiquetas_add_wcfm_endpoints() {
    add_rewrite_endpoint('etiquetas-correios', EP_PAGES);
}

// Carrega o formulário diretamente no endpoint
add_action('template_redirect', 'etiquetas_wcfm_template_redirect');
function etiquetas_wcfm_template_redirect() {
    global $wp_query;

    // Verifica se está no endpoint correto
    if (isset($wp_query->query_vars['etiquetas-correios'])) {
        if (!is_user_logged_in()) {
            // Se o usuário não estiver logado, redireciona para a página de login do WooCommerce
            wp_redirect(wp_login_url());
            exit;
        }

        // Carrega o layout completo do WCFM
        get_header();
        do_action('wcfm_load_views_before'); // Carrega os views antes do conteúdo
        do_action('wcfm_load_styles'); // Carrega os estilos do WCFM
        
        echo '<div class="wcfm-container">';
        echo '<div class="wcfm-content">';

        // Aqui a página de redirecionamento para os Correios
        echo '<div class="wrap correios-vendor-generate" style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #f9f9f9; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">';

        echo '<h1 style="font-size: 24px; color: #333;">' . __('Gerar Etiqueta de Envio', 'etiquetas-correios') . '</h1>';
        echo '<p style="font-size: 16px; color: #555;">' . __('Você será direcionado ao site dos Correios para gerar sua etiqueta. Faça login utilizando as credenciais fornecidas no bookmarklet abaixo.', 'etiquetas-correios') . '</p>';

        echo '<p style="font-size: 16px; color: #555;">' . __('Após o login, clique em "Remetente" e depois em "Novo Remetente". Em seguida, adicione o destinatário clicando em "Novo Destinatário".', 'etiquetas-correios') . '</p>';
        echo '<p style="font-size: 16px; color: #555;">' . __('Os pacotes para a geração de etiquetas a serem escolhidos são 03298 - PAC CONTRATO AG para PAC e 03220 - SEDEX CONTRATO AG para SEDEX no campo Solicitar faixa de etiquetas.', 'etiquetas-correios') . '</p>';

        // Adiciona o bookmarklet para preenchimento automático
        $username = get_option('etiquetas_correios_username', '');
        $password = get_option('etiquetas_correios_password', '');

        echo '<p><strong>' . __('Para preencher automaticamente seu usuário e senha no site dos Correios, arraste o bookmarklet abaixo para a barra de favoritos:', 'etiquetas-correios') . '</strong></p>';
        echo '<a id="bookmarklet-link" href="javascript:(function(){document.getElementById(\'username\').value=\'' . esc_js($username) . '\';document.getElementById(\'password\').value=\'' . esc_js($password) . '\';})()" style="display: inline-block; background-color: #0073aa; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">' . __('Preencher Usuário e Senha', 'etiquetas-correios') . '</a>';
        echo '<p style="font-size: 16px; color: #555;">' . __('Após abrir o site dos Correios, clique em "Adicionar bookmarklet" nas barras dos favoritos.', 'etiquetas-correios') . '</p>';

        // Botão "Gerar Etiquetas no site dos Correios"
        echo '<a href="https://cas.correios.com.br/login?service=https%3A%2F%2Fprepostagem.correios.com.br%2Flogin%2Fcas" target="_blank" style="display: inline-block; padding: 12px 20px; background-color: #0073aa; color: white; border-radius: 5px; text-decoration: none; font-size: 16px; margin-right: 10px; text-align: center; box-shadow: 0 4px 6px rgba(0, 115, 170, 0.3); transition: background-color 0.3s ease;">' . __('Gerar Etiquetas no site dos Correios', 'etiquetas-correios') . '</a>';

        // Botão "Voltar ao Store Manager"
        echo '<a href="' . wcfm_get_endpoint_url('store-manager') . '" style="display: inline-block; padding: 12px 20px; background-color: #f44336; color: white; border-radius: 5px; text-decoration: none; font-size: 16px; text-align: center; box-shadow: 0 4px 6px rgba(244, 67, 54, 0.3); transition: background-color 0.3s ease;">' . __('Voltar ao Store Manager', 'etiquetas-correios') . '</a>';

        echo '</div>'; // Fecha correios-vendor-generate
        echo '</div>'; // Fecha wcfm-content
        echo '</div>'; // Fecha wcfm-container

        get_footer();

        // Adiciona o JavaScript para excluir o bookmarklet após 90 segundos
        echo '<script>
        setTimeout(function() {
            var bookmarkletLink = document.getElementById("bookmarklet-link");
            bookmarkletLink.href = "javascript:void(0);"; // Remove a funcionalidade do bookmarklet
            bookmarkletLink.innerHTML = "' . __('Bookmarklet expirou', 'etiquetas-correios') . '"; // Muda o texto
            bookmarkletLink.style.pointerEvents = "none"; // Desabilita o clique
            bookmarkletLink.style.backgroundColor = "#ccc"; // Altera a cor do botão para indicar que expirou
            bookmarkletLink.style.color = "#666"; // Altera a cor do texto
        }, 90000); // 90 segundos
        </script>';

        exit; // Evita carregar qualquer outro template
    }
}

// Adiciona uma página de configurações para o administrador
add_action('admin_menu', 'etiquetas_correios_admin_menu');
function etiquetas_correios_admin_menu() {
    add_menu_page(
        __('Etiquetas Correios', 'etiquetas-correios'),
        __('Etiquetas Correios', 'etiquetas-correios'),
        'manage_options',
        'etiquetas-correios-settings',
        'etiquetas_correios_settings_page',
        'dashicons-admin-generic'
    );
}

// Página de configurações
function etiquetas_correios_settings_page() {
    // Verifica se o usuário tem permissão para gerenciar opções
    if (!current_user_can('manage_options')) {
        return;
    }

    // Salva as opções se o formulário foi enviado
    if (isset($_POST['etiquetas_correios_submit'])) {
        update_option('etiquetas_correios_username', sanitize_text_field($_POST['etiquetas_correios_username']));
        update_option('etiquetas_correios_password', sanitize_text_field($_POST['etiquetas_correios_password']));
        echo '<div class="updated"><p>' . __('Configurações salvas.', 'etiquetas-correios') . '</p></div>';
    }

    $username = get_option('etiquetas_correios_username', '');
    $password = get_option('etiquetas_correios_password', '');

    ?>
    <div class="wrap">
        <h1><?php _e('Configurações de Etiquetas Correios', 'etiquetas-correios'); ?></h1>
        <form method="post" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Usuário dos Correios', 'etiquetas-correios'); ?></th>
                    <td><input type="text" name="etiquetas_correios_username" value="<?php echo esc_attr($username); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Senha dos Correios', 'etiquetas-correios'); ?></th>
                    <td><input type="password" name="etiquetas_correios_password" value="<?php echo esc_attr($password); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(__('Salvar Configurações', 'etiquetas-correios'), 'primary', 'etiquetas_correios_submit'); ?>
        </form>
    </div>
    <?php
}
