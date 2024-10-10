<h2><?php _e('Configurações dos Correios', 'correios-wcfm-integration'); ?></h2>
<form method="post" action="options.php">
    <?php settings_fields('correios_settings_group'); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e('Usuário Correios', 'correios-wcfm-integration'); ?></th>
            <td><input type="text" name="correios_wcfm_usuario" value="<?php echo esc_attr(get_option('correios_wcfm_usuario')); ?>" /></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Cartão Correios Fácil', 'correios-wcfm-integration'); ?></th>
            <td><input type="text" name="correios_wcfm_cartao" value="<?php echo esc_attr(get_option('correios_wcfm_cartao')); ?>" /></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('API Key', 'correios-wcfm-integration'); ?></th>
            <td><input type="text" name="correios_wcfm_api_key" value="<?php echo esc_attr(get_option('correios_wcfm_api_key')); ?>" /></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
