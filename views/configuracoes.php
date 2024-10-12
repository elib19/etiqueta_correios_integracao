<div class="wrap">
    <h1><?php _e('Configurações Etiquetas Correios', 'etiquetas-correios'); ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('etiquetas-correios-settings-group');
        do_settings_sections('etiquetas-correios-settings-group');
        ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e('Usuário Correios', 'etiquetas-correios'); ?></th>
                <td><input type="text" name="etiquetas_correios_username" value="<?php echo esc_attr(get_option('etiquetas_correios_username')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Senha Correios', 'etiquetas-correios'); ?></th>
                <td><input type="password" name="etiquetas_correios_password" value="<?php echo esc_attr(get_option('etiquetas_correios_password')); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
