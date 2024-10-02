<h2>Configurações Correios</h2>
<form method="post" action="options.php">
    <?php settings_fields( 'correios_settings_group' ); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Usuário Correios</th>
            <td><input type="text" name="correios_user" value="<?php echo esc_attr( get_option('correios_user') ); ?>" /></td>
        </tr>
        <tr valign="top">
            <th scope="row">Cartão Correios</th>
            <td><input type="text" name="correios_cartao" value="<?php echo esc_attr( get_option('correios_cartao') ); ?>" /></td>
        </tr>
        <tr valign="top">
            <th scope="row">Chave API Correios</th>
            <td><input type="password" name="correios_api_key" value="<?php echo esc_attr( get_option('correios_api_key') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>
</form>
