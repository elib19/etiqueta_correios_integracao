<div class="wrap correios-admin-settings">
    <h1><?php _e('Configurações de Integração dos Correios', 'correios-wcfm-integration'); ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('correios_settings_group');
        do_settings_sections('correios-settings');
        submit_button();
        ?>
    </form>
</div>
?>
