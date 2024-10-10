<div class="wrap correios-vendor-generate">
    <h1><?php _e('Gerar Etiqueta de Envio', 'virtuaria-correios'); ?></h1>
    <form method="post" action="">
        <?php wp_nonce_field('gerar_etiqueta', 'gerar_etiqueta_nonce'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e('Destinatário', 'virtuaria-correios'); ?></th>
                <td><input type="text" name="destinatario" required /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Endereço', 'virtuaria-correios'); ?></th>
                <td><input type="text" name="endereco" required /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Cidade', 'virtuaria-correios'); ?></th>
                <td><input type="text" name="cidade" required /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Estado', 'virtuaria-correios'); ?></th>
                <td><input type="text" name="estado" required /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('CEP', 'virtuaria-correios'); ?></th>
                <td><input type="text" name="cep" required /></td>
            </tr>
        </table>
        <?php submit_button(__('Gerar Etiqueta', 'virtuaria-correios')); ?>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica o nonce para segurança
    if (isset($_POST['gerar_etiqueta_nonce']) && wp_verify_nonce($_POST['gerar_etiqueta_nonce'], 'gerar_etiqueta')) {
        $destinatario = sanitize_text_field($_POST['destinatario']);
        $endereco     = sanitize_text_field($_POST['endereco']);
        $cidade       = sanitize_text_field($_POST['cidade']);
        $estado       = sanitize_text_field($_POST['estado']);
        $cep          = sanitize_text_field($_POST['cep']);

        // Debug: Exibir os dados recebidos
        echo '<pre>' . print_r(compact('destinatario', 'endereco', 'cidade', 'estado', 'cep'), true) . '</pre>';

        // Utiliza as credenciais do administrador para gerar a etiqueta
        $api_key = get_option('virtuaria_correios_api_key');
        $usuario = get_option('virtuaria_correios_usuario');
        $cartao  = get_option('virtuaria_correios_cartao');

        // Debug: Verifica se as credenciais estão definidas
        echo '<pre>' . print_r(compact('api_key', 'usuario', 'cartao'), true) . '</pre>';

        // Verifica se a classe Correios_Helper e o método gerarEtiqueta existem
        if (class_exists('Correios_Helper') && method_exists('Correios_Helper', 'gerarEtiqueta')) {
            $etiqueta_url = Correios_Helper::gerarEtiqueta($destinatario, $endereco, $cidade, $estado, $cep, $usuario, $cartao, $api_key);

            if (is_wp_error($etiqueta_url)) {
                echo '<div class="notice notice-error"><p>' . $etiqueta_url->get_error_message() . '</p></div>';
            } else {
                echo '<div class="notice notice-success"><p>' . __('Etiqueta gerada com sucesso! Baixe a etiqueta abaixo:', 'virtuaria-correios') . '</p>';
                echo '<a href="' . esc_url($etiqueta_url) . '" class="button button-primary" target="_blank">' . __('Baixar Etiqueta', 'virtuaria-correios') . '</a></div>';
            }
        } else {
            echo '<div class="notice notice-error"><p>' . __('Erro: Classe ou método de geração de etiqueta não encontrados.', 'virtuaria-correios') . '</p></div>';
        }
    } else {
        echo '<div class="notice notice-error"><p>' . __('Token inválido. Tente novamente.', 'virtuaria-correios') . '</p></div>';
    }
}
