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
            <tr valign="top">
                <th scope="row"><?php _e('Cartão de Postagem', 'virtuaria-correios'); ?></th>
                <td><input type="text" name="cartao_postagem" required /></td>
            </tr>
        </table>
        <?php submit_button(__('Gerar Etiqueta', 'virtuaria-correios')); ?>
    </form>
</div>
