<?php
// views/correios-wcfm-view.php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<div class="wcfm-clearfix"></div>
<div class="collapse wcfm-collapse" id="wcfm_correios_etiquetas">
    <div class="wcfm-page-headig">
        <span class="wcfmfa fa-envelope"></span>
        <span class="wcfm-page-heading-text"><?php _e('Gerar Etiqueta Correios', 'correios-wcfm'); ?></span>
        <?php do_action('wcfm_page_heading'); ?>
    </div>

    <div class="wcfm-collapse-content">
        <div id="wcfm_page_load"></div>

        <?php do_action('before_wcfm_correios_etiquetas'); ?>

        <div class="wcfm-container">
            <div id="wcfm_correios_etiquetas_expander" class="wcfm-content">
                <h2><?php _e('Gerar nova etiqueta', 'correios-wcfm'); ?></h2>
                <form method="post" action="">

                    <label for="destinatario"><?php _e('Destinatário', 'correios-wcfm'); ?></label>
                    <input type="text" name="destinatario" id="destinatario" required />

                    <label for="endereco"><?php _e('Endereço', 'correios-wcfm'); ?></label>
                    <input type="text" name="endereco" id="endereco" required />

                    <label for="cidade"><?php _e('Cidade', 'correios-wcfm'); ?></label>
                    <input type="text" name="cidade" id="cidade" required />

                    <label for="estado"><?php _e('Estado', 'correios-wcfm'); ?></label>
                    <input type="text" name="estado" id="estado" required />

                    <label for="cep"><?php _e('CEP', 'correios-wcfm'); ?></label>
                    <input type="text" name="cep" id="cep" required />

                    <input type="submit" name="gerar_etiqueta" value="<?php _e('Gerar Etiqueta', 'correios-wcfm'); ?>" />

                </form>
            </div>
        </div>
    </div>
</div>
