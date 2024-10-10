<!-- templates/correios-wcfm-view.php -->
<div class="wcfm-page-headig">
    <span class="wcfmfa fa-envelope"></span>
    <span class="wcfm-page-heading-text"><?php _e('Gerar Etiqueta Correios', 'correios-wcfm'); ?></span>
</div>

<div class="wcfm-collapse-content">
    <p><?php _e('Aqui o vendedor pode gerar uma etiqueta para enviar o produto pelos Correios.', 'correios-wcfm'); ?></p>

    <!-- Formulário para gerar a etiqueta -->
    <form method="post" action="">
        <label for="destinatario"><?php _e('Destinatário', 'correios-wcfm'); ?></label>
        <input type="text" id="destinatario" name="destinatario" required>

        <label for="endereco"><?php _e('Endereço', 'correios-wcfm'); ?></label>
        <input type="text" id="endereco" name="endereco" required>

        <label for="cidade"><?php _e('Cidade', 'correios-wcfm'); ?></label>
        <input type="text" id="cidade" name="cidade" required>

        <label for="estado"><?php _e('Estado', 'correios-wcfm'); ?></label>
        <input type="text" id="estado" name="estado" required>

        <label for="cep"><?php _e('CEP', 'correios-wcfm'); ?></label>
        <input type="text" id="cep" name="cep" required>

        <input type="submit" value="<?php _e('Gerar Etiqueta', 'correios-wcfm'); ?>">
    </form>
</div>
