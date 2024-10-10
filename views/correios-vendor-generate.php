<div class="wrap correios-vendor-generate">
    <h1><?php _e('Gerar Etiqueta de Envio', 'correios-wcfm-integration'); ?></h1>
    <form method="post" action="">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e('Destinatário', 'correios-wcfm-integration'); ?></th>
                <td><input type="text" name="destinatario" required /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Endereço', 'correios-wcfm-integration'); ?></th>
                <td><input type="text" name="endereco" required /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Cidade', 'correios-wcfm-integration'); ?></th>
                <td><input type="text" name="cidade" required /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Estado', 'correios-wcfm-integration'); ?></th>
                <td><input type="text" name="estado" required /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('CEP', 'correios-wcfm-integration'); ?></th>
                <td><input type="text" name="cep" required /></td>
            </tr>
        </table>
        <?php submit_button(__('Gerar Etiqueta', 'correios-wcfm-integration')); ?>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $destinatario = sanitize_text_field($_POST['destinatario']);
    $endereco     = sanitize_text_field($_POST['endereco']);
    $cidade       = sanitize_text_field($_POST['cidade']);
    $estado       = sanitize_text_field($_POST['estado']);
    $cep          = sanitize_text_field($_POST['cep']);

    $etiqueta_url = Correios_Helper::gerarEtiqueta($destinatario, $endereco, $cidade, $estado, $cep);

    if (is_wp_error($etiqueta_url)) {
        echo '<div class="notice notice-error"><p>' . $etiqueta_url->get_error_message() . '</p></div>';
    } else {
        echo '<div class="notice notice-success"><p>' . __('Etiqueta gerada com sucesso! Baixe a etiqueta abaixo:', 'correios-wcfm-integration') . '</p>';
        echo '<a href="' . esc_url($etiqueta_url) . '" class="button button-primary" target="_blank">' . __('Baixar Etiqueta', 'correios-wcfm-integration') . '</a></div>';
    }
}
